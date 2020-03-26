// JavaScript Document


        jQuery(function ($) {
            /**
             * A jQuery plugin that loads data from HTML tables, Google Sheets and data arrays and draws charts
			 using Google Charts.
             *
             * Using HTML Tables
             * HTML tables can help make the chart data accessible.
             * You can either display the table with the chart or accessibly hide the table
             *
             * Suggested HTML Table setup
             * Create an HTML table with a caption and 'th' elements in the first row
             * For each 'th' element apply one of the following
             * 'data-type' attribute: 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'
             * or 'data-role' attribute:  'tooltip','annotation'
             * The caption element's text is used as a title for the chart by default.
             *
             * Apply the jQuery Chartinator plugin to the chart canvas(es)
             * or select the table(s) and Chartinator will insert a new chart canvas(es) after the table
             * or create js data arrays
             * See examples below and the readme file for more info
             */

            // Bar Chart Example
            var chart1 = $('#barChart').chartinator({

                // Custom Options ------------------------------------------------------

                // The Google Sheet key
                // The id code of the Google sheet taken from the public url of your Google Sheet
                // Default: false
                //googleSheetKey: '1kg6f4UVJPpT45D7ucAE8lhsVp8vIUl7bSMM442_DrhI',

                // The jQuery selector of the HTML table element to extract the data from - String
                // Default: false
                // If unspecified, the element this plugin is applied to must be the HTML table
                // or js columns and rows arrays must be defined
                //tableSel: '.barChart',

                // The chart type - String
                // Derived from the Google Charts visualization class name
                // Default: 'BarChart'
                // Use TitleCase names. eg. BarChart, PieChart, ColumnChart, Calendar, GeoChart, Table.
                // See Google Charts Gallery for a complete list of Chart types
                // https://developers.google.com/chart/interactive/docs/gallery
                chartType: 'BarChart',

                // The data title
                // A title used to identify the set of data
                // Used as a caption when generating an HTML table
                dataTitle: 'Bar Chart Data',

                // The class to apply to the table element
                tableClass: 'col-table',

                // Create Table - String
                // Create a basic HTML table or a Google Table Chart from chart data
                // Options: false, 'basic-table', 'table-chart'
                // Note: This table will replace an existing HTML table
                createTable: false,

                // Transpose data Boolean - swap columns and rows
                // Default: false
               // transpose: false,

                // Ignore row indexes array - An array of row index numbers to ignore
                // Default: []
                // Note: Only works when extracting data from HTML tables or Google Sheets
                // The headings row is index 0
                //ignoreRow: [],

                // Ignore column indexes array
                // An array of column indexes to ignore in the HTML table or Google Sheet
                // Default: []
                // Note: Only works on data extracted from HTML tables or Google Sheets
                //ignoreCol: [],

                // The tooltip concatenation - Defines a string for concatenating a custom tooltip.
                // Keywords: 'domain', 'data', 'label' - these will be replaced with current values
                // 'domain': the primary axis value, 'data': the data value, 'label': the column title
                // Default: false - use Google Charts tooltip defaults
                // Not supported on pie, calendar charts
                //tooltipConcat: 'domain - label: data',

                // The chart aspect ratio custom option - width/height
                // Used to calculate the chart dimensions relative to the width or height
                // this is overridden if the Google Chart's height and width options have values
                // Suggested value: 1.25
                // Default: false - not used
                //chartAspectRatio: 1.25,

                // Google Bar Chart Options
                barChart: {

                    // Width of chart in pixels - Number
                    // Default: automatic (unspecified)
                    width: null,

                    // Height of chart in pixels - Number
                    // Default: automatic (unspecified)
                    height: 400,

                    chartArea: {
                        left: "20%",
                        top: 30,
                        width: "74%",
                        height: "80%"
                    },

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: false - Use Google Charts defaults
                    //fontSize: 'body',

                    // Font-family name - String
                    // Default: The body font-family
                    fontName: 'Roboto',

                    // Chart Title - String
                    // Default: Table caption.
                    title: 'Bar Chart',

                    titleTextStyle: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: 'h4'
                    },
                    legend: {

                        // Legend position - String
                        // Options: bottom, top, left, right, in, none.
                        // Default: bottom
                        position: 'bottom'
                    },

                    // Array of colours
                    colors: ['#e248b3'],

                    // Stack values within a bar or column chart - Boolean
                    // Default: false.
                    isStacked: false,

                    tooltip: {

                        // Shows tooltip with values on hover - String
                        // Options: focus, none.
                        // Default: focus
                        trigger: 'focus'
                    }
                },

                // Show table as well as chart - String
                // Options: 'show', 'hide', 'remove'
                showTable: 'hide'
            });

            //  Pie Chart Example
            var chart2 = $('#pieChart').chartinator({

                // Custom Options ------------------------------------------------------
                // Note: This example appends data from a data array
                // to the data extracted from an HTML table
                // Google Charts does not support custom tooltips or annotations on Pie Charts

                // Append the following rows of data to the data extracted from the table
                //rows: [
                //    ['France', 5],
                //    ['Mexico', 2]],

                // Create Table - String
                // Create a basic HTML table or a Google Table Chart from chart data
                // Options: false, 'basic-table', 'table-chart'
                // Note: This table will replace an existing HTML table
                createTable: false,

                // The data title
                // A title used to identify the set of data
                // Used as a caption when generating an HTML table
                dataTitle: 'Pie Chart Data - Table Chart',

                // The chart type - String
                // Derived from the Google Charts visualization class name
                // Default: 'BarChart'
                // Use TitleCase names. eg. BarChart, PieChart, ColumnChart, Calendar, GeoChart, Table.
                // See Google Charts Gallery for a complete list of Chart types
                // https://developers.google.com/chart/interactive/docs/gallery
                chartType: 'PieChart',

                // The class to apply to the chart container element
                chartClass: 'col',

                // The class to apply to the table element
                tableClass: 'col-table',

                // The chart aspect ratio custom option - width/height
                // Used to calculate the chart dimensions relative to the width or height
                // this is overridden if the Google Chart's height and width options have values
                // Suggested value: 1.25
                // Default: false - not used
                //chartAspectRatio: 1.25,

                // Google Pie Chart Options
                pieChart: {

                    // Width of chart in pixels - Number
                    // Default: automatic (unspecified)
                    width: 500,

                    // Height of chart in pixels - Number
                    // Default: automatic (unspecified)
                    height: 400,

                    chartArea: {
                        left: "10%",
                        top: 30,
                        width: "94%",
                        height: "100%"
                    },

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: false - Use Google Charts defaults
                    fontSize: 'body',

                    // The font family name. String
                    // Default: body font family
                    fontName: 'Roboto',

                    // Chart Title - String
                    // Default: Table caption.
                    //title: 'Pie Chart',

                    titleTextStyle: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: 'h4'
                    },
                    legend: {

                        // Legend position - String
                        // Options: bottom, top, left, right, in, none.
                        // Default: right
                        position: 'right'
                    },

                    // Array of colours
                    colors: ['#94ac27', '#3691ff', '#e248b3', '#f58327', '#bf5cff', '#669', '#09F'],

                    // Make chart 3D - Boolean
                    // Default: false.
                    is3D: true,

                    tooltip: {

                        // Shows tooltip with values on hover - String
                        // Options: focus, none.
                        // Default: focus
                        trigger: 'focus'
                    }
                },
                // Show table as well as chart - String
                // Options: 'show', 'hide', 'remove'
                showTable: 'hide'
            });
			
			//  Column Chart Example
            var chart3 = $('#columnChart').chartinator({

                // Custom Options ------------------------------------------------------
                // note: This example uses js data arrays for data instead of HTML tables

                // Columns - The columns data-array
				/*
			   columns: [
                    {label: 'Motnhs', type: 'string'},
                    {label: '2017 School Income', type: 'number'},
					{label: '2017 School Expenses', type: 'number'}],

                // Rows - The rows data-array
                // If colIndexes array has values the row data will be inserted into the columns
                // defined in the colindexes array. Otherwise the row data will be appended
                // to any existing row data extracted from an HTML table or Google Sheet
                rows: [
                    ['JAN', 18, 50],
					['FEB', 19, 16],
					['MAR', 13, 45],
					['APR', 38, 90],
					['MAY', 58, 34],
					['JUN', 68, 90],
					['JUL', 39, 31],
					['AUG', 71, 91],
					['SEP', 65, 43],
					['OCT', 98, 50],
					['NOV', 40, 34],
					['DEC', 98, 78]],
				*/
                // The class to apply to the table element
                tableClass: 'col-table',

                // Create Table
                // Create an HTML table from chart data
                // Note: This table will replace an existing HTML table
                // Default: false
                createTable: false,

                // The chart type - String
                // Derived from the Google Charts visualization class name
                // Default: 'BarChart'
                // Use TitleCase names. eg. BarChart, PieChart, ColumnChart, Calendar, GeoChart, Table.
                // See Google Charts Gallery for a complete list of Chart types
                // https://developers.google.com/chart/interactive/docs/gallery
                chartType: 'ColumnChart',

                // The data title
                // A title used to identify the set of data
                // Used as a caption when generating an HTML table
                dataTitle: 'Column Chart Data',

                // The chart aspect ratio custom option - width/height
                // Used to calculate the chart dimensions relative to the width or height
                // this is overridden if the Google Chart's height and width options have values
                // Suggested value: 1.25
                // Default: false - not used
                chartAspectRatio: 1.5,

                // Google Column Chart Options
                columnChart: {

                    // Width of chart in pixels - Number
                    // Default: automatic (unspecified)
                    width: null,

                    // Height of chart in pixels - Number
                    // Default: automatic (unspecified)
                    //height: 200,

                    chartArea: {
                        left: "10px",
                        top: 30,
                        width: "90%",
                        height: "65%"
                    },

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: false - Use Google Charts defaults
                    //fontSize: 'body',

                    // Font-family name - String
                    // Default: 'Arial'
                    fontName: 'Roboto',

                    // Chart Title - String
                    // Default: Table caption.
                    title: 'School Sales, Income and Expenses Chart',

                    titleTextStyle: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: 'h3'
                    },
                    legend: {

                        // Legend position - String
                        // Options: bottom, top, left, right, in, none.
                        // Default: right
                        position: 'bottom'
                    },

                    // Array of colours
                    colors: ['#228B22', '#8B008B', '#DC143C', '#ff99e1'],

                    // Stack values within a bar or column chart - Boolean
                    // Default: false.
                    isStacked: true,

                    tooltip: {

                        // Shows tooltip with values on hover - String
                        // Options: focus, none.
                        // Default: focus
                        trigger: 'focus'
                    }
                },

                // Show table as well as chart - String
                // Options: 'show', 'hide', 'remove'
                showTable: 'hide'
            });
			
			});
		