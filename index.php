<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Styling for sorting arrows */
    .sort-arrows {
        display: inline-block;
        width: 0;
        height: 0;
        vertical-align: middle;
        content: "";
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
    }

    .sort-up {
        border-bottom: 5px solid;
    }

    .sort-down {
        border-top: 5px solid;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Employee List</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- Table Headers with Sorting Functionality -->
                    <th onclick="sortTable(0)" style="cursor: pointer;">First Name <span class="sort-arrows"></span>
                    </th>
                    <th onclick="sortTable(1)" style="cursor: pointer;">Last Name <span class="sort-arrows"></span></th>
                    <th onclick="sortTable(2)" style="cursor: pointer;">Email <span class="sort-arrows"></span></th>
                    <th onclick="sortTable(3)" style="cursor: pointer;">Phone Number <span class="sort-arrows"></span>
                    </th>
                    <th onclick="sortTable(4)" style="cursor: pointer;">Hire Date <span class="sort-arrows"></span></th>
                    <th onclick="sortTable(5)" style="cursor: pointer;">Job Name <span class="sort-arrows"></span></th>
                    <th onclick="sortTable(6)" style="cursor: pointer;">Salary <span class="sort-arrows"></span></th>
                    <th onclick="sortTable(7)" style="cursor: pointer;">Commission Pct <span class="sort-arrows"></span>
                    </th>
                    <th onclick="sortTable(8)" style="cursor: pointer;">Manager Name <span class="sort-arrows"></span>
                    </th>
                    <th onclick="sortTable(9)" style="cursor: pointer;">Department Name <span
                            class="sort-arrows"></span></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="employeeTable">
                <!-- PHP code to fetch and display employee data -->
                <?php
                $employees = array(
                    array("John", "Doe", "john.doe@example.com", "123-456-7890", "2023-01-15", "Developer", 60000, 5, "Jane Smith", "IT"),
                    array("Jane", "Smith", "jane.smith@example.com", "987-654-3210", "2022-03-20", "Manager", 80000, 10, "Michael Johnson", "HR"),
                    array("Michael", "Johnson", "michael.johnson@example.com", "456-789-0123", "2021-07-10", "Designer", 55000, 7, "Emily Brown", "Design"),
                    array("Emily", "Brown", "emily.brown@example.com", "321-654-0987", "2020-05-18", "Developer", 65000, 6, "John Doe", "IT"),
                    array("Christopher", "Lopez", "christopher.lopez@example.com", "654-321-9870", "2019-11-25", "Analyst", 52000, 4, "Jane Smith", "Finance"),
                    array("Amanda", "Davis", "amanda.davis@example.com", "789-012-3456", "2022-08-30", "HR Specialist", 57000, 8, "Michael Johnson", "HR"),
                    array("Sarah", "Martinez", "sarah.martinez@example.com", "890-123-4567", "2021-01-05", "Marketing Manager", 75000, 12, "Christopher Lopez", "Marketing"),
                    array("James", "Miller", "james.miller@example.com", "234-567-8901", "2020-06-15", "Sales Representative", 62000, 5, "Amanda Davis", "Sales"),
                    array("Patricia", "Wilson", "patricia.wilson@example.com", "567-890-1234", "2023-02-12", "Data Scientist", 80000, 9, "Emily Brown", "IT"),
                    array("David", "Garcia", "david.garcia@example.com", "012-345-6789", "2022-12-01", "Project Manager", 90000, 10, "Sarah Martinez", "Projects")
                );


                foreach ($employees as $employee) {
                    echo "<tr>";
                    echo "<td>" . $employee[0] . "</td>";
                    echo "<td>" . $employee[1] . "</td>";
                    echo "<td>" . $employee[2] . "</td>";
                    echo "<td>" . $employee[3] . "</td>";
                    echo "<td>" . $employee[4] . "</td>";
                    echo "<td>" . $employee[5] . "</td>";
                    echo "<td>" . $employee[6] . "</td>";
                    echo "<td>" . $employee[7] . "</td>";
                    echo "<td>" . $employee[8] . "</td>";
                    echo "<td>" . $employee[9] . "</td>";
                    echo '<td><button class="btn btn-danger btn-sm" onclick="deleteEmployee(this)">Delete</button></td>';
                    echo "</tr>";
                }
                ?>
                <!-- Row for adding new employee -->
                <tr id="newEmployeeRow">
                    <td><input type="text" class="form-control" id="firstName"></td>
                    <td><input type="text" class="form-control" id="lastName"></td>
                    <td><input type="email" class="form-control" id="email"></td>
                    <td><input type="text" class="form-control" id="phoneNumber"></td>
                    <td><input type="date" class="form-control" id="hireDate"></td>
                    <td><input type="text" class="form-control" id="jobName"></td>
                    <td><input type="number" class="form-control" id="salary"></td>
                    <td><input type="number" class="form-control" id="commissionPct"></td>
                    <td><input type="text" class="form-control" id="managerName"></td>
                    <td><input type="text" class="form-control" id="departmentName"></td>
                    <td><button class="btn btn-success btn-sm" onclick="addEmployee()">Add</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function sortTable(column) {
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("employeeTable");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[column];
                y = rows[i + 1].getElementsByTagName("TD")[column];
                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
        // Add arrows for sorting indication
        let arrows = document.querySelectorAll(".sort-arrows");
        arrows.forEach(arrow => {
            arrow.classList.remove("sort-up", "sort-down");
        });
        arrows[column].classList.toggle("sort-up", dir === "asc");
        arrows[column].classList.toggle("sort-down", dir === "desc");
    }

    function deleteEmployee(button) {
        if (confirm("Are you sure you want to delete this employee?")) {
            let row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    }

    function addEmployee() {
        let firstName = document.getElementById("firstName").value;
        let lastName = document.getElementById("lastName").value;
        let email = document.getElementById("email").value;
        let phoneNumber = document.getElementById("phoneNumber").value;
        let hireDate = document.getElementById("hireDate").value;
        let jobName = document.getElementById("jobName").value;
        let salary = document.getElementById("salary").value;
        let commissionPct = document.getElementById("commissionPct").value;
        let managerName = document.getElementById("managerName").value;
        let departmentName = document.getElementById("departmentName").value;

        if (firstName && lastName && email && phoneNumber && hireDate && jobName && salary && commissionPct &&
            managerName && departmentName) {
            let table = document.getElementById("employeeTable");
            let newRow = table.insertRow(table.rows.length - 1);
            newRow.innerHTML = `
                    <td>${firstName}</td>
                    <td>${lastName}</td>
                    <td>${email}</td>
                    <td>${phoneNumber}</td>
                    <td>${hireDate}</td>
                    <td>${jobName}</td>
                    <td>${salary}</td>
                    <td>${commissionPct}</td>
                    <td>${managerName}</td>
                    <td>${departmentName}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteEmployee(this)">Delete</button></td>
                `;
            // Clear input fields after adding new employee
            document.getElementById("firstName").value = "";
            document.getElementById("lastName").value = "";
            document.getElementById("email").value = "";
            document.getElementById("phoneNumber").value = "";
            document.getElementById("hireDate").value = "";
            document.getElementById("jobName").value = "";
            document.getElementById("salary").value = "";
            document.getElementById("commissionPct").value = "";
            document.getElementById("managerName").value = "";
            document.getElementById("departmentName").value = "";
        } else {
            alert("Please fill in all fields.");
        }
    }
    </script>
</body>

</html>