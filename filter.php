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

/**
 * This filter adds the indicator of context used for formatting
 *
 * @package    filter_testcontext
 * @copyright  2013 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Activity name filtering
 */
class filter_testcontext extends moodle_text_filter {

    function filter($text, array $options = array()) {
        if (!empty($text)) {
            switch ($this->context->contextlevel) {
                case CONTEXT_BLOCK: $prefix = 'B'; break;
                case CONTEXT_COURSE: 
                    if ($this->context->instanceid == SITEID) {
                        $prefix = 'F';
                    } else {
                        $prefix = 'C';
                    }
                    break;
                case CONTEXT_COURSECAT: $prefix = 'G'; break;
                case CONTEXT_MODULE: $prefix = 'M'; break;
                case CONTEXT_SYSTEM: $prefix = 'S'; break;
                case CONTEXT_USER: $prefix = 'B'; break;
                default: $prefix = $this->context->contextlevel.':';
            }
            $backtrace = debug_backtrace();
            $contextset = false;
            foreach ($backtrace as $funccall) {
                if (($funccall['function'] === 'format_string' ||
                        $funccall['function'] === 'format_text') &&
                                !empty($funccall['args'][2])) {
                    $formatoptions = (array)$funccall['args'][2];
                    $contextset = !empty($formatoptions['context']);
                }
            }
            if (!$contextset) {
                $prefix = '*'. $prefix;
            }
            return '<sub>'.$prefix.'</sub> '.$text;
        } else {
            return $text;
        }
    }
}
