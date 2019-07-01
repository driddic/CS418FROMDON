<?php

$str = "A 'quote' <!-- is <b>bold</b>";

// Outputs: A 'quote' is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str);
echo "<br>";
// Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str, ENT_QUOTES);

$fire = "what does <!-- means";

echo "<br>";

echo htmlspecialchars($fire);

 ?>
