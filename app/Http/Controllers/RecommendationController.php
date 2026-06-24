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

       $courses = \App\Models\Course::all();

$careerMap = [

    // Rekayasa Perangkat Lunak
    'Software Engineer' => 'Rekayasa Perangkat Lunak',
    'Mobile Developer' => 'Rekayasa Perangkat Lunak',
    'Game Developer' => 'Rekayasa Perangkat Lunak',

    // AI & Data
    'Data Scientist' => 'Kecerdasan Buatan & Data',
    'AI Engineer' => 'Kecerdasan Buatan & Data',

    // Jaringan & Keamanan
    'Cyber Security Analyst' => 'Jaringan & Keamanan Siber',
    'Cloud Engineer' => 'Jaringan & Keamanan Siber',
];

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
KARIR
*/
if (
    isset($careerMap[$student->career_preference]) &&
    $careerMap[$student->career_preference] == $course->bidang
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
(
    isset($careerMap[$student->career_preference]) &&
    $careerMap[$student->career_preference] == $course->bidang
)
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
            'hasil' => $bestPackages[0]['package']
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

$careerMap = [

    // Rekayasa Perangkat Lunak
    'Software Engineer' => 'Rekayasa Perangkat Lunak',
    'Mobile Developer' => 'Rekayasa Perangkat Lunak',
    'Game Developer' => 'Rekayasa Perangkat Lunak',

    // AI & Data
    'Data Scientist' => 'Kecerdasan Buatan & Data',
    'AI Engineer' => 'Kecerdasan Buatan & Data',

    // Jaringan & Keamanan
    'Cyber Security Analyst' => 'Jaringan & Keamanan Siber',
    'Cloud Engineer' => 'Jaringan & Keamanan Siber',
];

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
if (
    isset($careerMap[$career]) &&
    $careerMap[$career] == $course->bidang
) {
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
                'career_score' =>
(
    isset($careerMap[$career]) &&
    $careerMap[$career] == $course->bidang
)
? 25
: 0,
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

    public function students()
{
    $students = Student::with(
        'interests',
        'grades'
    )->get();

    return view(
        'students',
        compact('students')
    );
}
}
