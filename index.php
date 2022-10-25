<!-- 

    PRIMO ESERCIZIO PHP + SQL

    Consegna: collegati al database tramite php, definisci una query complessa e mostrala nel browser. 

-->

<?php

define("DB_SERVERNAME", "localhost:3306");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db-university");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die();
}

echo "<p>Connection OK!<p/>";

$sql = "SELECT DISTINCT `teachers`.`surname` AS `teacher_surname`, `teachers`.`name` AS `teacher_name`, `departments`.`name` AS `department_name`
FROM `teachers`
INNER JOIN `course_teacher`
ON `teachers`.`id` = `course_teacher`.`teacher_id`
INNER JOIN `courses`
ON `course_teacher`.`course_id` = `courses`.`id`
INNER JOIN `degrees`
ON `courses`.`degree_id` = `degrees`.`id`
INNER JOIN `departments`
ON `degrees`.`department_id` = `departments`.`id`
WHERE `departments`.`name` = 'Dipartimento di Matematica'
ORDER BY `teachers`.`surname` ASC;";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div>
            <?php
            echo $row['teacher_surname'] . ' ' . $row['teacher_name'] . ' - ' . $row['department_name']
            ?>
        </div>
<?php
    }
} elseif ($result) {
    echo "0 results";
} else {
    echo "query error";
    die();
}
