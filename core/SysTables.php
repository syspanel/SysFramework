<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace Core;

/**
 * SysTables - Simple table generator class with search, sorting, and pagination
 * 
 * Technical comments:
 * - Pagination supports page and rows per page query parameters
 * - Search is performed on all columns
 * - Sorting supports ascending and descending order
 * - All output is HTML-rendered
 * - Designed for server-side handling using GET parameters
 */
class SysTables {
    private $data;          // Full dataset array
    private $columns;       // Columns to display
    private $currentPage;   // Current page number
    private $rowsPerPage;   // Number of rows per page
    private $totalRows;     // Total number of rows

    /**
     * Constructor
     * Initializes the table with data, columns, and optionally rows per page.
     * Also handles GET parameters for page, search, and sort.
     *
     * @param array $data Table data (array of associative arrays)
     * @param array $columns Column names
     * @param int $defaultRowsPerPage Default number of rows per page
     */
    public function __construct($data = [], $columns = [], $defaultRowsPerPage = 10) {
        $this->data = $data;
        $this->columns = $columns;
        $this->currentPage = 1;
        $this->rowsPerPage = isset($_GET['rowsPerPage']) ? (int)$_GET['rowsPerPage'] : $defaultRowsPerPage;
        $this->totalRows = count($data);

        // Handle page selection via GET parameter
        if (isset($_GET['page'])) {
            $this->setPage((int)$_GET['page']);
        }

        // Handle search via GET parameter
        if (isset($_GET['search'])) {
            $this->data = $this->search($_GET['search']);
        }

        // Handle sorting via GET parameters
        if (isset($_GET['sort'])) {
            $this->sort($_GET['sort'], $_GET['order'] ?? 'asc');
        }
    }

    /**
     * Re-initialize table with new data and columns
     *
     * @param array $data Table data
     * @param array $columns Column names
     */
    public function initialize($data, $columns) {
        $this->data = $data;
        $this->columns = $columns;
        $this->totalRows = count($data);
    }

    /**
     * Set current page number and validate within range
     *
     * @param int $page Page number
     */
    public function setPage($page) {
        $this->currentPage = max(1, min($page, $this->getTotalPages()));
    }

    /**
     * Get total number of pages
     *
     * @return int Total pages
     */
    public function getTotalPages() {
        return ceil($this->totalRows / $this->rowsPerPage);
    }

    /**
     * Search table for a query string across all columns
     *
     * @param string $query Search keyword
     * @return array Filtered dataset
     */
    public function search($query) {
        return array_filter($this->data, function($row) use ($query) {
            foreach ($row as $value) {
                if (stripos($value, $query) !== false) {
                    return true; // Match found
                }
            }
            return false; // No match in this row
        });
    }

    /**
     * Sort table by a column in ascending or descending order
     *
     * @param string $column Column name
     * @param string $order 'asc' or 'desc'
     */
    public function sort($column, $order) {
        usort($this->data, function($a, $b) use ($column, $order) {
            return ($order === 'asc') ? strcmp($a[$column], $b[$column]) : strcmp($b[$column], $a[$column]);
        });
    }

    /**
     * Render search input and rows per page dropdown
     *
     * @return string HTML content
     */
    public function renderSearchAndRowsPerPage() {
        $html = '<input type="text" id="search" placeholder="Search..." 
          onkeypress="if(event.key === \'Enter\') searchTable(this.value)">';

        $html .= '<label for="rowsPerPage">Show:</label>';
        $html .= '<select id="rowsPerPage" onchange="setRowsPerPage(this.value)">';
        foreach ([5, 10, 15, 20, 30] as $value) {
            $selected = ($value == $this->rowsPerPage) ? 'selected' : '';
            $html .= "<option value=\"$value\" $selected>$value</option>";
        }
        $html .= '</select>';

        return $html;
    }

    /**
     * Render the table as HTML
     *
     * @return string HTML table
     */
    public function renderTable() {
        $start = ($this->currentPage - 1) * $this->rowsPerPage;
        $pagedData = array_slice($this->data, $start, $this->rowsPerPage);

        $html = '<table class="table"><thead><tr>';
        foreach ($this->columns as $column) {
            $html .= "<th onclick=\"sortTable('$column')\">$column</th>";
        }
        $html .= '</tr></thead><tbody>';

        foreach ($pagedData as $row) {
            $html .= '<tr>';
            foreach ($this->columns as $column) {
                $html .= "<td>{$row[$column]}</td>";
            }
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }

    /**
     * Render pagination buttons
     *
     * @return string HTML pagination
     */
    public function renderPagination() {
        $totalPages = $this->getTotalPages();
        $html = '<div class="pagination" style="text-align: center;">';

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $this->currentPage) ? 'active' : '';
            $html .= "<a href=\"?page=$i\" class=\"$active\">$i</a> ";
        }

        $html .= '</div>';
        return $html;
    }
}
