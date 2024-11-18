{{-- font awesome --}}
<script src="https://kit.fontawesome.com/87dd173a0d.js" crossorigin="anonymous"></script>

{{-- Change Theme --}}
<script>
    const themeToggle = document.getElementById('theme-toggle');
    const themeLabel = document.getElementById('theme-label');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Atur tema saat halaman pertama kali dibuka
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
        // themeLabel.textContent = 'Light Mode';
        themeIcon.classList.add('fa-sun');
    } else {
        // themeLabel.textContent = 'Dark Mode';
        themeIcon.classList.add('fa-moon');
    }

    // Toggle tema dan simpan preferensi
    themeToggle.addEventListener('click', () => {
        const isDarkMode = document.documentElement.classList.toggle('dark');
        const newTheme = isDarkMode ? 'dark' : 'light';
        // themeLabel.textContent = isDarkMode ? 'Light Mode' : 'Dark Mode';
        themeIcon.classList.toggle('fa-sun');
        themeIcon.classList.toggle('fa-moon');
        localStorage.setItem('theme', newTheme);
    });
</script>

{{-- JQuery --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}

{{-- Tailwind --}}
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}

{{-- Datatables --}}
{{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
<script>
    new DataTable('#dataTables');
</script> --}}

{{-- Alpine JS --}}
<script src="//unpkg.com/alpinejs" defer></script>

{{-- Chart JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>

<script type="text/javascript">
    /* Make dynamic date appear */
    (function() {
        if (document.getElementById("get-current-year")) {
            document.getElementById("get-current-year").innerHTML =
                new Date().getFullYear();
        }
    })();
    /* Sidebar - Side navigation menu on mobile/responsive mode */
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("bg-white");
        document.getElementById(collapseID).classList.toggle("m-2");
        document.getElementById(collapseID).classList.toggle("py-3");
        document.getElementById(collapseID).classList.toggle("px-6");
    }
    /* Function for dropdowns */
    function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
            placement: "bottom-start"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
    }

    (function() {
        /* Chart initialisations */
        /* Line Chart */
        var config = {
            type: "line",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July"
                ],
                datasets: [{
                        label: new Date().getFullYear(),
                        backgroundColor: "#4c51bf",
                        borderColor: "#4c51bf",
                        data: [65, 78, 66, 44, 56, 67, 75],
                        fill: false
                    },
                    {
                        label: new Date().getFullYear() - 1,
                        fill: false,
                        backgroundColor: "#fff",
                        borderColor: "#fff",
                        data: [40, 68, 86, 74, 56, 60, 87]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                title: {
                    display: false,
                    text: "Sales Charts",
                    fontColor: "white"
                },
                legend: {
                    labels: {
                        fontColor: "white"
                    },
                    align: "end",
                    position: "bottom"
                },
                tooltips: {
                    mode: "index",
                    intersect: false
                },
                hover: {
                    mode: "nearest",
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: "rgba(255,255,255,.7)"
                        },
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: "Month",
                            fontColor: "white"
                        },
                        gridLines: {
                            display: false,
                            borderDash: [2],
                            borderDashOffset: [2],
                            color: "rgba(33, 37, 41, 0.3)",
                            zeroLineColor: "rgba(0, 0, 0, 0)",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2]
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(255,255,255,.7)"
                        },
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: "Value",
                            fontColor: "white"
                        },
                        gridLines: {
                            borderDash: [3],
                            borderDashOffset: [3],
                            drawBorder: false,
                            color: "rgba(255, 255, 255, 0.15)",
                            zeroLineColor: "rgba(33, 37, 41, 0)",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2]
                        }
                    }]
                }
            }
        };
        var ctx = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(ctx, config);

        /* Bar Chart */
        config = {
            type: "bar",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July"
                ],
                datasets: [{
                        label: new Date().getFullYear(),
                        backgroundColor: "#ed64a6",
                        borderColor: "#ed64a6",
                        data: [30, 78, 56, 34, 100, 45, 13],
                        fill: false,
                        barThickness: 8
                    },
                    {
                        label: new Date().getFullYear() - 1,
                        fill: false,
                        backgroundColor: "#4c51bf",
                        borderColor: "#4c51bf",
                        data: [27, 68, 86, 74, 10, 4, 87],
                        barThickness: 8
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                title: {
                    display: false,
                    text: "Orders Chart"
                },
                tooltips: {
                    mode: "index",
                    intersect: false
                },
                hover: {
                    mode: "nearest",
                    intersect: true
                },
                legend: {
                    labels: {
                        fontColor: "rgba(0,0,0,.4)"
                    },
                    align: "end",
                    position: "bottom"
                },
                scales: {
                    xAxes: [{
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: "Month"
                        },
                        gridLines: {
                            borderDash: [2],
                            borderDashOffset: [2],
                            color: "rgba(33, 37, 41, 0.3)",
                            zeroLineColor: "rgba(33, 37, 41, 0.3)",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2]
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: "Value"
                        },
                        gridLines: {
                            borderDash: [2],
                            drawBorder: false,
                            borderDashOffset: [2],
                            color: "rgba(33, 37, 41, 0.2)",
                            zeroLineColor: "rgba(33, 37, 41, 0.15)",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2]
                        }
                    }]
                }
            }
        };
        ctx = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(ctx, config);
    })();
</script>

{{-- Popper JS --}}
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script>
    /* Make dynamic date appear */
    (function() {
        if (document.getElementById("get-current-year")) {
            document.getElementById("get-current-year").innerHTML =
                new Date().getFullYear();
        }
    })();
    /* Function for opning navbar on mobile */
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
    /* Function for dropdowns */
    function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
            placement: "bottom-start"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
    }
</script>
