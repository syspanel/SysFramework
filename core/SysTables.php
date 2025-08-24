<?php

namespace Core;

class SysTables {
    private $data;
    private $columns;
    private $currentPage;
    private $rowsPerPage;
    private $totalRows;

    public function __construct($data = [], $columns = [], $defaultRowsPerPage = 10) {
        $this->data = $data;
        $this->columns = $columns;
        $this->currentPage = 1;
        // Define o número de linhas por página baseado na entrada do usuário ou um valor padrão
        $this->rowsPerPage = isset($_GET['rowsPerPage']) ? (int)$_GET['rowsPerPage'] : $defaultRowsPerPage;
        $this->totalRows = count($data);
        
        if (isset($_GET['page'])) {
            $this->setPage((int)$_GET['page']);
        }
        
        if (isset($_GET['search'])) {
            $this->data = $this->search($_GET['search']);
        }
        
        if (isset($_GET['sort'])) {
            $this->sort($_GET['sort'], $_GET['order'] ?? 'asc');
        }
    }

    public function initialize($data, $columns) {
        $this->data = $data;
        $this->columns = $columns;
        $this->totalRows = count($data);
    }

    public function setPage($page) {
        $this->currentPage = max(1, min($page, $this->getTotalPages()));
    }

    public function getTotalPages() {
        return ceil($this->totalRows / $this->rowsPerPage);
    }

    public function search($query) {
        return array_filter($this->data, function($row) use ($query) {
            foreach ($row as $value) {
                if (stripos($value, $query) !== false) {
                    return true;
                }
            }
            return false;
        });
    }

    public function sort($column, $order) {
        usort($this->data, function($a, $b) use ($column, $order) {
            return ($order === 'asc') ? strcmp($a[$column], $b[$column]) : strcmp($b[$column], $a[$column]);
        });
    }

    public function renderSearchAndRowsPerPage() {
        $html = '<input type="text" id="search" placeholder="Buscar..." oninput="searchTable(this.value)">';

        $html .= '<label for="rowsPerPage">Exibir:</label>';
        $html .= '<select id="rowsPerPage" onchange="setRowsPerPage(this.value)">';
        foreach ([5, 10, 15, 20, 30] as $value) {
            $selected = ($value == $this->rowsPerPage) ? 'selected' : '';
            $html .= "<option value=\"$value\" $selected>$value</option>";
        }
        $html .= '</select>';

        return $html;
    }

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

    public function renderPagination() {
        $totalPages = $this->getTotalPages();
        $html = '<div class="pagination" style="text-align: center;">'; // Centraliza os botões

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $this->currentPage) ? 'active' : '';
            $html .= "<a href=\"?page=$i\" class=\"$active\">$i</a> ";
        }

        $html .= '</div>';
        return $html;
    }
}
