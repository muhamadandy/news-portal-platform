<?php

namespace Tests\Unit;

use App\Models\Report;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function test_user_can_report_comment()
    {
        // Simulasi data komentar yang dilaporkan
        $commentData = [
            'id' => 1,
            'content' => 'This is a test comment.',
            'user_id' => 2,
        ];

        // Simulasi data pelaporan
        $reportData = [
            'comment_id' => $commentData['id'],
            'user_id' => 1, // User yang melaporkan
        ];

        // Membuat instance Report
        $report = new Report($reportData);

        // Memastikan data Report sesuai
        $this->assertEquals($commentData['id'], $report->comment_id);
        $this->assertEquals(1, $report->user_id);
    }
}