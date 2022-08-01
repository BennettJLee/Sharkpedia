<?php
    $doc = new DOMDocument();
    $doc->load('../Sharkpedia/sharks.xml');
    $sharks = $doc->getElementsByTagName('shark'); // loads the xml doc file in
    // class.object.item.string kind of idea going on here, or container
    //string like c#. where node value is parsing it as a string
    //$name = $shark->getElementsByTagName('name')->item(0)->nodeValue;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script>
  </head>
  <body id="browseBG">
    <?php include 'navbar.php'; ?>
    <div class="btn-group">
      <button class="btn" onclick="filterSelection('all')">Show All</button>
      <button class="btn" onclick="filterSelection('EX')">Extinct</button>
      <button class="btn" onclick="filterSelection('CR')">Critically Endangered</button>
      <button class="btn" onclick="filterSelection('EN')">Endangered</button>
      <button class="btn" onclick="filterSelection('VU')">Vulnerable</button>
      <button class="btn" onclick="filterSelection('NT')">Near Threatened</button>
      <button class="btn" onclick="filterSelection('LC')">Least Concern</button>
      <button class="btn" onclick="filterSelection('DD')">Data Deficient</button>
    </div>
    <div class="sharkcontainer">
      <form class='card tag' action="../php/finder.php">
            <input class="sharkFinder" type="text" name="search" placeholder="Search for Sharks">
            <input class="submit" type="submit" value="Submit">
      </form>
      <?php //makes a list of sharks by iterating and printing.
      //it uses the same system as the sharkinfo page
        foreach ($sharks as $s) {
            $st = $s->getElementsByTagName('st')->item(0)->nodeValue;
            $status = $s->getElementsByTagName('status')->item(0)->nodeValue;
            $id = $s->getAttribute('id'); //gets id
            $name = $s->getElementsByTagName('name')->item(0)->nodeValue;
            $namesci = $s->getElementsByTagName('namesci')->item(0)->nodeValue;
            $imagePath = $s->getElementsByTagName('image')->item(0)->getAttribute('path');
            echo "<div class='filter show $st'>";
            echo "<a href=\"sharkinfo.php?id=$id\">";
            echo "<div class='card'>";
            echo "<div class='cardTitle'>";
            echo "<p id='name'>$name</p>"; //puts id into the url bar to be accessed by shark info
            echo "<h2 id='sciname'>$namesci</h2>";
            echo "<div class='statDiv' id='$st'>";
            echo "<p>$st</p>";
            echo "</div>";
            echo "<h2 id='status'>$status</h2>";
            echo "</div>";
            echo "<div class='sharkmask'>";
            echo "<img src=\"../Sharkpedia/imagesharks/$imagePath\"/>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
      ?>
    </div>
  </body>
</html>
