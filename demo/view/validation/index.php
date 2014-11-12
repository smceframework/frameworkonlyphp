<?php

$validator = new SmGump();

echo "\nBEFORE SANITIZE:\n\n";

echo "<pre>";
print_r($invalid_data);

echo "\nAFTER SANITIZE:\n\n";
print_r($validator->sanitize($invalid_data));

echo "\nTHESE ALL FAIL:\n\n";
$validator->validate($invalid_data, $rules);

// Print out the errors using the new get_readable_errors() method:
print_r($validator->get_readable_errors());

if($validator->validate($valid_data, $rules)) {
	echo "\nTHESE ALL SUCCEED:\n\n";
	print_r($valid_data);
}

echo "\nDONE\n\n";

echo "</pre>";
?>