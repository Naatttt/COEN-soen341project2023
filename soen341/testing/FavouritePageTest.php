<?php
//declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/Search/BACK_apply.php";

use PHPUnit\Framework\TestCase;

class FavouritePageTest extends TestCase
{
    //checks if outputs the favorite saved from student
    public function TableFavorite()
    {
        $_SESSION['username'] = 'anna';
        define('DB_PASSWORD', 'password');
        $conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');

        //simulate a student adding favorite 
        $postingid = 1;
        $sql_add_favourite = "INSERT INTO favourites (student, postingid) VALUES ('anna', $postingid)";
        mysqli_query($conn_postings, $sql_add_favourite);
        ob_start();
        include 'webpages/Students/favorites.php';
        $output = ob_get_clean();

        //makes sure contains the correct headers
        $expected_output = '<div class="cell" style="width: 100px"><h3 class="text-white postings-size" style="font-size: 1.5em">Id</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Position</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Company</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Industry</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Location</h3></div>';
        $expected_output .= '<div class="cell" style="width: 100px"><h3 class="text-white postings-size" style="font-size: 1.5em">Salary</h3></div>';
        $expected_output .= '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
        $expected_output .= '<a href="/soen341/webpages/Search/position.php?id=1" style="display: contents">';
        $expected_output .= '<div class="cell" style="width: 100px"><h3 class=" postings-size">1</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class=" postings-size">Test position</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class=" postings-size">Test company</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class=" postings-size">Test industry</h3></div>';
        $expected_output .= '<div class="cell" style="width: 300px"><h3 class=" postings-size">Test location</h3></div>';
        $expected_output .= '<div class="cell" style="width: 100px"><h3 class=" postings-size">100000</h3></div>';
        $expected_output .= '</a>';
        $expected_output .= '</div>';
        $expected_output .= '</table>';

        if (strpos($output, $expected_output) === false) {
            echo "test failed";
        } else {

        }

    }


}

?>