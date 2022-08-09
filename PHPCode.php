<?php

class PHPCode
{
  public $code;

  function __construct($code = "")
  {
    $this->code = $code;
  }

  function checkValidity()
  {
    $bracketsStackLength = 0;

    for ($i = 0; $i < strlen($this->code); $i++) {
      $currentSymbol = $this->code[$i];

      if ($currentSymbol === "{") {
        $bracketsStackLength++;
      } elseif ($currentSymbol === "}") {
        if ($bracketsStackLength > 0) {
          $bracketsStackLength--;
        } else {
          return false;
        }
      }
    }

    if ($bracketsStackLength > 0) {
      return false;
    }

    return true;
  }
}

$codes = [
  "",
  "qwe",
  "{}{}{{}{}}",
  "}{{qwe}qwe}{",
  "qwe{qwe{{}qwe{}}qwe}qwe",
  "}{}",
];

echo "<body>";

echo "
  <style>
    body {
      font-family: sans-serif;
      font-size: 24px;
    }

    li {
      margin: 1rem 0;
    }

    code {
      font-weight: bold;
    }

    .correct {
      color: green;
    }

    .uncorrect {
      color: red;
    }
  </style>
";

echo "<h1>PHP code</h1>";

echo "<ul>";

foreach ($codes as $code) {
  $phpCode = new PHPCode($code);

  echo "<li>";

  echo "<code>";
  if (empty($code)) {
    echo "*пустая строка*";
  } else {
    echo $code;
  }
  echo "</code>";

  echo ": ";

  if ($phpCode->checkValidity()) {
    echo "<span class=\"correct\">корректный код</span>";
  } else {
    echo "<span class=\"uncorrect\">некорректный код</span>";
  }

  echo "</li>";
}

echo "</ul>";

echo "</body>";
