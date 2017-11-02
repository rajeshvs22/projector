<?php
/*$data = array('cat',2,4,10);              -> Original Array
 * $sortOrder = array('10','2','4','cat');  -> User Sort Array
 */
$sortOrder = array('10','2','4','cat'); 
function cmp($a, $b) {
   global $sortOrder ;

    $sortOrderPositionA = array_values(array_keys($sortOrder, $a));
    $sortOrderPositionB = array_values(array_keys($sortOrder, $b));

    if ($sortOrderPositionA == $sortOrderPositionB) {
        return 0;
    }
    return ($sortOrderPositionA < $sortOrderPositionB) ? -1 : 1;
}
//$data = array('cat',2,4,10);
//$dataSorted = uasort($data, 'cmp');
//echo "<pre>"; print_r($data);

//////////////////////////////////////////////////////////////

?>