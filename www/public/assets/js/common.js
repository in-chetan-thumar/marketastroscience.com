function initializeChoicesAndTable(
    selectElement,
    dataTable,
    alwaysVisibleColumns,
    defaultVisibleColumns,
    columnKey
) {
    // Get column names and indices from the DataTable instance
    var columnNames = dataTable
        .columns()
        .header()
        .toArray()
        .map(function (th, index) {
            return { name: $(th).text().trim(), index: index };
        });

    // Filter out columns specified in alwaysVisibleColumns
    columnNames = columnNames.filter(function (col) {
        return !alwaysVisibleColumns.includes(col.index);
    });

    // Initialize Choices for the multiple select element
    var multipleCancelButton = new Choices(selectElement, {
        removeItemButton: true,
        placeholderValue: "Select columns",
        searchResultLimit: 5,
        renderChoiceLimit: 5,
        choices: columnNames.map(function (col) {
            return {
                value: col.index.toString(), // Use index as value
                label: col.name, // Use column name as label
            };
        }),
    });

    // Set selected options in the dropdown for default visible columns
    var defaultSelectedValues = defaultVisibleColumns.map(String); // Convert indices to strings
    multipleCancelButton.setChoiceByValue(defaultSelectedValues);

    // Initial visibility based on selected columns
    dataTable.columns().visible(false);
    defaultVisibleColumns.forEach(function (columnIndex) {
        dataTable.column(columnIndex).visible(true);
    });
    alwaysVisibleColumns.forEach(function (columnIndex) {
        dataTable.column(columnIndex).visible(true);
    });

    // On change event for the Choices multiple select
    $(selectElement).on("change", function () {
        var selectedColumns = $(this).val() || [];
        setCookie(columnKey, JSON.stringify(selectedColumns), 7);

        // Hide all columns initially
        dataTable.columns().visible(false);

        // Show selected columns
        selectedColumns.forEach(function (columnIndex) {
            dataTable.column(parseInt(columnIndex)).visible(true);
        });

        // Ensure alwaysVisibleColumns remain visible
        alwaysVisibleColumns.forEach(function (columnIndex) {
            dataTable.column(columnIndex).visible(true);
        });
    });
}


// filters
// Function to update table data based on filters
function filterTableData(table) {
    var formData = $("#form-search").serialize();
    $.ajax({
        url: $("#form-search").attr("action"),
        type: "GET",
        data: formData,
        success: function (response) {
            table.clear().rows.add(response).draw();
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        },
    });
}



// Utility function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Utility function to get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Debounce function to prevent rapid calls
function debounce(func, wait) {
    let timeout;
    return function () {
        const context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

// Reusable function to initialize a DataTable with AJAX, filtering, and column visibility
function initializeDataTable({
    moduleNmae,
    tableSelector,
    ajaxUrl,
    columnsConfig,
    searchInputSelector,
    rowsPerPageDropdownSelector,
    columnSelectElement,
    filters = [],  // Array of filter objects { name, selector }
    dropdowns = [],  // Array of dropdown objects { selector }
    alwaysVisibleColumns = [],
    defaultVisibleColumn = [],
    exportButtonSelector,
    exportEndPoint,
}) {

    if (exportButtonSelector != null && exportEndPoint != null) {
        $(exportButtonSelector).on('click', function (e) {
            e.preventDefault();

            // Construct query parameters
            var queryParams = {};
            filters.forEach(filter => {
                queryParams[filter.name] = $(filter.selector).val();
            });

            // Construct the export URL with query parameters
            var exportUrl = exportEndPoint + '?' + $.param(queryParams);

            // Redirect to the export URL
            window.location.href = exportUrl;
        });
    };

    const table = $(tableSelector).DataTable({
        destroy: true,
        searching: false,
        serverSide: true, // Enable server-side processing
        paging: true, // Enable pagination
        language: {
            searchPlaceholder: "Search records..."
        },
        ajax: {
            url: ajaxUrl,
            dataSrc: function (json) {
                return json.data;
            },
            data: function (d) {
                // Attach filters directly to the `d` object
                filters.forEach(filter => {
                    d[filter.name] = $(filter.selector).val();
                });
            }

        },
        order: [], // Disable initial ordering
        columns: columnsConfig
    });
    let debounceTimer;
    $(searchInputSelector).on('keypress input', function (e) {
        // Only trigger on 'Enter' key or on input changes (including deletions)
        if (e.type === 'keypress' && e.key !== 'Enter') {
            return; // Skip if it's a keypress but not 'Enter'
        }
        e.preventDefault(); // Prevent the default behavior for the 'Enter' key
        clearTimeout(debounceTimer); // Clear previous timer
        debounceTimer = setTimeout(function () {
            table.draw(); // Call your table draw function after debounce
        }, 500);
    });

    // Filtering input with debounce
    $(searchInputSelector).on('input', debounce(function () {
        table.draw();
    }, 500));

    // Dynamic dropdown handling
    if (dropdowns != []) {
        dropdowns.forEach(dropdown => {
            $(dropdown.selector).on('change', function () {
                table.draw();
            });
        });
    }

    //
    const selectedRowskey = moduleNmae + '-rows-per-page';
    const moduleKey = moduleNmae;
    const columnKey = moduleKey + '-visible-columns';

    $(rowsPerPageDropdownSelector).on('change', function () {
        const selectedRows = $(this).val();
        setCookie(selectedRowskey, selectedRows, 7);
        table.page.len(selectedRows).draw();
    });

    const savedRowsPerPage = getCookie(selectedRowskey);
    if (savedRowsPerPage) {
        $(rowsPerPageDropdownSelector).val(savedRowsPerPage);
        table.page.len(savedRowsPerPage).draw();
    }


    const savedColumns = getCookie(columnKey);
    const defaultColumns = savedColumns ? JSON.parse(savedColumns) : defaultVisibleColumn;

    initializeChoicesAndTable(columnSelectElement, table, alwaysVisibleColumns, defaultColumns, columnKey);

    // $(columnSelectElement).on('change', function () {
    //     const selectedColumns = $(this).val() || [];
    //     setCookie(columnKey, JSON.stringify(selectedColumns), 7);
    // });

}

// Handle export button click
function initializeExportDataTable() {
    $('#estimate-event-export-button').on('click', function (e) {
        e.preventDefault();
        var exportUrl = "{{ route('estimate.event.export') }}";
        var queryParams = $.param({
            start_date: $('#start-date').val(),
            end_date: $('#end-date').val(),
            client_id: $('#client-id').val(),
            status: $('#estimate-status').val(),
            query_str: $('#search-input').val(),
        });
        window.location.href = exportUrl + '?' + queryParams;
    });
}
