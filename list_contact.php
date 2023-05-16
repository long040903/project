<!DOCTYPE html>
<html>
<head>
  <title>Contact Table</title>
  <style>
.contact-table {
  width: 100%;
  border-collapse: collapse;
}

.contact-table th, .contact-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.contact-table th {
  background-color: #f2f2f2;
  font-weight: bold;
  color: #333;
}

.contact-table tr:hover {
  background-color: #f5f5f5;
}

.contact-table td {
  font-size: 14px;
  color: #555;
}

h2 {
  margin-bottom: 20px;
  color: #333;
  text-align: center;
}
  </style>
</head>
<body>
  <h2>Contact</h2>
  <?php
    require_once "./connect.php";

  $sql = "SELECT * FROM contact";
  $result = $conn->query($sql);
  ?>
  
  <table class="contact-table">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Message</th>
    </tr>
    <?php foreach ($result as $row): ?>
      <tr>
        <td><?php echo $row["username"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["phone"]; ?></td>
        <td><?php echo $row["message"]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  
  <?php

  $conn->close();
  ?>
</body>
</html>
