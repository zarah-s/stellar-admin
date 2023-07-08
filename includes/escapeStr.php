<?php
function escape($conn,$content){
   return mysqli_real_escape_string($conn,$content);
}