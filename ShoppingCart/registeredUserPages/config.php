<?php

// DB config
DEFINE("DB_HOST", "localhost");
DEFINE("DB_NAME", "ShoppingCart");
DEFINE("DB_USER", "root");
DEFINE("DB_PASS", "");

// Pagination config
DEFINE("PAGN_LIMIT", (isset($_GET['limit'])) ? $_GET['limit'] : 5);
DEFINE("PAGN_PAGE", (isset($_GET['page'])) ? $_GET['page'] : 1);
DEFINE("PAGN_LINKS", (isset($_GET['links'])) ? $_GET['links'] : 7);