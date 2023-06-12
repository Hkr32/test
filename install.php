<?php

if (PHP_SAPI !== 'cli') {
    exit('Run this script via the command line instead.'."\n");
}

$config = require __DIR__.'/bootstrap.php';

const CODE_NUMBER = 500_000;
const CODE_LENGTH = 10;
const INSERT_CHUNK = 50_000;

function generateCode(int $length): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $maxCharIndex = strlen($characters) - 1;
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[mt_rand(0, $maxCharIndex)];
    }

    return $code;
}

$db = new \App\Database\Database(
    $config['db']['host'],
    $config['db']['name'],
    $config['db']['user'],
    $config['db']['password']
);

$createPromoCodesTable = <<<SQL
CREATE TABLE IF NOT EXISTS `promocodes`(
  `id` INT AUTO_INCREMENT,
  `user_id` INT NULL,
  `code` VARCHAR(10) NOT NULL,
  `busy_at` TIMESTAMP NULL,
  PRIMARY KEY(`id`),
  UNIQUE KEY user_id_code_unique (`user_id`, `code`)
);
SQL;

$startTime = microtime(1);

$db->getConnection()->exec($createPromoCodesTable);

$exists = $db->query('SELECT EXISTS(SELECT 1 FROM `promocodes`) AS `already`')->fetch();

if ($exists['already']) {
    exit('The database is already full. Aborted.'."\n");
}

echo 'Processing...'."\n";

$codes = [];
$count = 0;

while ($count < CODE_NUMBER) {
    $code = generateCode(CODE_LENGTH);

    if (empty($codes[$code])) {
        $codes[$code] = "('$code')";
        ++$count;
    }
}

foreach (array_chunk($codes, INSERT_CHUNK) as $chunk) {
    $insertValues = implode(',', $chunk);

    $db->getConnection()->exec("INSERT INTO `promocodes` (`code`) VALUES $insertValues");
}

$endTime = microtime(1) - $startTime;

echo 'Done in '.$endTime.'s. '.CODE_NUMBER.' rows inserted.'."\n";
