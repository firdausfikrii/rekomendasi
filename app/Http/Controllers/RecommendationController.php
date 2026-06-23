<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function generate($studentId)
    {
        $student = Student::with(
            'interests',
            'grades'
        )->findOrFail($studentId);

        $courses = Course::all();

        $results = [];

        foreach ($courses as $course) {

            $score = 0;

            /*
             Minat
            */

            $interestMatch =
                $student->interests
                ->where('name', $course->bidang)
                ->count();

            if ($interestMatch) {
                $score += 40;
            }

            /*
             Karir
            */

            if (
                strtolower($student->career_preference)
                ==
                strtolower($course->bidang)
            ) {
                $score += 25;
            }

            /*
             Nilai
            */

            $avgGrade = 80;

            if (
                $student->grades->count() > 0
            ) {

                $avgGrade =
                    $student->grades
                    ->map(function ($g) {

                        return match ($g->grade) {
                            'A' => 100,
                            'A-' => 90,
                            'B+' => 85,
                            'B' => 80,
                            default => 70
                        };
                    })
                    ->avg();
            }

            $score += $avgGrade * 0.35;

            $results[] = [
                'course' => $course->nama,
                'bidang' => $course->bidang,

                'interest_score' => $interestMatch ? 40 : 0,

                'career_score' =>
                strtolower($student->career_preference)
                    ==
                    strtolower($course->bidang)
                    ? 25
                    : 0,

                'grade_score' =>
                round($avgGrade * 0.35, 2),

                'score' => round($score, 2)
            ];
        }

        usort(
            $results,
            fn($a, $b)
            =>
            $b['score']
                <=>
                $a['score']
        );

        $combinations = $this->combinations(
            $results,
            2
        );

        $packageScores = [];

        foreach ($combinations as $combo) {

            $total = 0;

            $names = [];

            foreach ($combo as $course) {

                $total += $course['score'];

                $names[] = $course['course'];
            }

            $packageScores[] = [
                'package' => implode(' + ', $names),
                'score' => $total
            ];
        }

        usort(
            $packageScores,
            fn($a, $b)
            =>
            $b['score']
                <=>
                $a['score']
        );

        $bestPackages = array_slice(
            $packageScores,
            0,
            5
        );

        $decisionTree = [
            'Apakah minat sesuai bidang?' => 'Ya',
            'Apakah nilai rata-rata > 80?' => 'Ya',
            'Apakah preferensi karir sesuai?' => 'Ya',
            'Hasil' => $bestPackages[0]['package']
        ];
        return view(
            'recommendation',
            compact(
                'results',
                'bestPackages',
                'decisionTree'
            )
        );
    }
    public function relation()
    {
        $students = Student::with('interests')->get();

        return view(
            'relation',
            compact('students')
        );
    }

    private function combinations($items, $r)
    {
        $result = [];

        $this->combine(
            $items,
            $result,
            [],
            0,
            $r
        );

        return $result;
    }

    private function combine(
        $items,
        &$result,
        $current,
        $start,
        $r
    ) {
        if (count($current) == $r) {
            $result[] = $current;
            return;
        }

        for (
            $i = $start;
            $i < count($items);
            $i++
        ) {

            $newCurrent = $current;

            $newCurrent[] = $items[$i];

            $this->combine(
                $items,
                $result,
                $newCurrent,
                $i + 1,
                $r
            );
        }
    }
    public function process(Request $request)
    {
        $interest = $request->interest;
        $grade = $request->grade;
        $career = $request->career;

        $courses = \App\Models\Course::all();

        $results = [];

        foreach ($courses as $course) {

            $score = 0;

            /*
        MINAT
        */
            if ($interest == $course->bidang) {
                $score += 40;
            }

            /*
        KARIR
        */
            if (strtolower($career) == strtolower($course->bidang)) {
                $score += 25;
            }

            /*
        NILAI
        */
            $score += $grade * 0.35;

            $results[] = [
                'course' => $course->nama,
                'bidang' => $course->bidang,
                'interest_score' => ($interest == $course->bidang) ? 40 : 0,
                'career_score' => (strtolower($career) == strtolower($course->bidang)) ? 25 : 0,
                'grade_score' => round($grade * 0.35, 2),
                'score' => round($score, 2)
            ];
        }

        // sorting
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);
        $combinations = $this->combinations($results, 2);

        $packageScores = [];

        foreach ($combinations as $combo) {

            $total = 0;
            $names = [];

            foreach ($combo as $course) {
                $total += $course['score'];
                $names[] = $course['course'];
            }

            $packageScores[] = [
                'package' => implode(' + ', $names),
                'score' => $total
            ];
        }

        usort($packageScores, fn($a, $b) => $b['score'] <=> $a['score']);

        $bestPackages = array_slice($packageScores, 0, 5);

        $decisionTree = [
            'minat' => $request->interest,
            'nilai' => $request->grade,
            'karir' => $request->career,
            'hasil' => $bestPackages[0]['package'] ?? '-'
        ];

        return view(
            'recommendation',
            compact(
                'results',
                'bestPackages',
                'decisionTree'
            )
        );
    }
}
