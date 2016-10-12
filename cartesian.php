<?php
//File1.txt and File2.txt are two text files for which we have to do cartesian products
$filecontents1 = file_get_contents("File1.txt");
$filecontents2 = file_get_contents("Fill2.txt");
$arr = array();//declaring array for hashmaps as array<?php
//File1.txt and File2.txt are two text files for which we have to do cartesian products
$filecontents1 = file_get_contents("File1.txt");
$filecontents2 = file_get_contents("Fill2.txt");
//$words = preg_split('/[\s,]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY);
//$a = preg_split('/(?<=["=>"])\b\s*/, subject)$words;
$arr = array();//declaring array for hashmaps

function htb($x,$stringname1,$stringname2,$arr,$y)/*this function recursively extract each words from both the files and store the product in the form of key => value pair where the key is the content from File1.txt and Value is the Content from File2.txt. File3 store the cartesian product of the two files i.e. File1 and Fill2 */
{

	$hasha = preg_split('/[\s,]+/', $stringname1, -1, PREG_SPLIT_NO_EMPTY); //splitting the file content and storing it as an array
	$hasha2 = preg_split('/[\s,]+/', $stringname2, -1, PREG_SPLIT_NO_EMPTY);//splitting the file content and storing it as an array
	if ($x > count($hasha)-1) { //counting the number of words in the file by counting the size of array
			return (count($hasha)-1);
		} else {
					$arr[$hasha[$x]] = $hasha2[$y]; /*creating hash table with key value pair of both the files i.e. File1.txt and File2.txt*/
					$str1 = "$hasha[$x] => $hasha2[$y] "; /* storing the key value pair as a string and then appending the string to the file */
					file_put_contents("File3.txt",$str1,FILE_APPEND); /* puttinh the string formed into File3.txt which will have the final cartesian product sets*/

					htb($x+1,$stringname1,$stringname2,$arr,$y);
		}	

}

function htb1($y,$filecontents1,$filecontents2,$arr)/*this function is used to control the recursion and producing right cartesian pairs which is used by htb function*/
{
	$hasha2 = preg_split('/[\s,]+/', $filecontents2, -1, PREG_SPLIT_NO_EMPTY);
	
	if($y > (count($hasha2)-1))
	{
		return (count($hasha2)-1);
	} else{
		
		htb(0,$filecontents1,$filecontents2,$arr,$y);
		htb1($y+1,$filecontents1,$filecontents2,$arr);
	}
}

htb1(0,$filecontents1,$filecontents2,$arr); //we start recursion here we assumed that the File1.txt is non-empty

?>