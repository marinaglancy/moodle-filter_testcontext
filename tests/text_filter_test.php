<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace filter_testcontext;

/**
 * Tests for Test context of applied filter
 *
 * @covers     \filter_testcontext\text_filter
 * @package    filter_testcontext
 * @category   test
 * @copyright  Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class text_filter_test extends \advanced_testcase {
    /**
     * Tests the filtering
     */
    public function test_filtering(): void {
        global $DB;
        $this->resetAfterTest(true);

        filter_set_global_state('testcontext', TEXTFILTER_ON);
        filter_set_applies_to_strings('testcontext', true);

        $filtered = format_text('Zero', FORMAT_HTML);
        $this->assertEquals('<sub>*S</sub> Zero', $filtered);

        $filtered = format_text('One', FORMAT_HTML, ['context' => \context_system::instance()]);
        $this->assertEquals('<sub>S</sub> One', $filtered);

        $cat = $DB->get_record('course_categories', []);
        $filtered = format_string('Two', true, ['context' => \context_coursecat::instance($cat->id)]);
        $this->assertEquals('G Two', $filtered);

        $filtered = format_string('Three');
        $this->assertEquals('*S Three', $filtered);
    }
}
