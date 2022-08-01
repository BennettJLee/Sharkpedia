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
    <div class="sharkcontainer">
        
        <?php //makes a list of sharks by iterating and printing.
      //it uses the same system as the sharkinfo page
            $empty = false;
            if (array_key_exists('search', $_GET)) {
                $sharksSearch = $_GET['search'];
        
                echo "<div class='card tag'>";
                echo "<div class='cardTitle'>";
                echo "<p id='name'>Results for: $sharksSearch</p>";
                echo "</div>";
                echo "</div>";
            }
            else {
                $sharksSearch = '';
                $empty = true;
                
                echo "<div class='card tag'>";
                echo "<div class='cardTitle'>";
                echo "<p id='name'>Showing all sharks</p>";
                echo "</div>";
                echo "</div>";
            }
        
            //echo array_search($sharksSearch,$sharks,true);
        $result = false;
        foreach ($sharks as $s) {
            // Convert both the current shark's name to lowercase and the search query to lowercase using strtolower()
            // Then determine if the search query appears within the shark's name using strpos()
            if ((strpos(strtolower($s->getElementsByTagName('name')->item(0)->nodeValue), strtolower($sharksSearch)) !== false) || $empty) {
                $result = true;
                
                $id = $s->getAttribute('id'); //gets id
                $name = $s->getElementsByTagName('name')->item(0)->nodeValue;
                $namesci = $s->getElementsByTagName('namesci')->item(0)->nodeValue;
                $imagePath = $s->getElementsByTagName('image')->item(0)->getAttribute('path');
                echo "<a href=\"sharkinfo.php?id=$id\">";
                echo "<div class='card tag'>";
                echo "<div class='cardTitle'>";
                echo "<p id='name'>$name</p>"; //puts id into the url bar to be accessed by shark info
                echo "<h2 id='sciname'>$namesci</h2>";
                echo "</div>";
                echo "<div class='sharkmask'>";
                echo "<img src=\"../Sharkpedia/imagesharks/$imagePath\"/>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        }
        
        if (!$result) {
            echo "<div class='card tag'>";
            echo "<div class='cardTitle'>";
            echo "<p id='name'>No results found for: $sharksSearch</p>";
            echo "</div>";
            echo "</div>";
        }
   
        
        /*foreach ($sharks as $s) {
            $id = $s->getAttribute('id'); //gets id
            $name = $s->getElementsByTagName('name')->item(0)->nodeValue;
            $namesci = $s->getElementsByTagName('namesci')->item(0)->nodeValue;
            $imagePath = $s->getElementsByTagName('image')->item(0)->getAttribute('path');
            echo "<a href=\"sharkinfo.php?id=$id\">";
            echo "<div class='card tag'>";
            echo "<div class='cardTitle'>";
            echo "<p id='name'>$name</p>"; //puts id into the url bar to be accessed by shark info
            echo "<h2 id='sciname'>$namesci</h2>";
            echo "</div>";
            echo "<div class='sharkmask'>";
            echo "<img src=\"../Sharkpedia/imagesharks/$imagePath\"/>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }*/
      ?>
    
    </div>
           <a class="sharkBack" id="back" href="browse.php"><span>Back</span></a>
  </body>
</html>