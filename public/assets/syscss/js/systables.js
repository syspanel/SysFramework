
        function sortTable(column) {
            const currentOrder = getUrlParameter('order') === 'asc' ? 'desc' : 'asc';
            window.location.href = `?sort=${column}&order=${currentOrder}`;
        }

        function searchTable(value) {
            window.location.href = `?search=${value}`;
        }

        function setRowsPerPage(value) {
            window.location.href = `?rowsPerPage=${value}&page=1`; // Reseta para a página 1 ao mudar o número de linhas
        }

        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }
