<?php

function book_url()
{
	return "asset/img/books/";
};

function fileNameWithoutExtension($fileName)
{
   return pathinfo($fileName, PATHINFO_FILENAME);
}

?>