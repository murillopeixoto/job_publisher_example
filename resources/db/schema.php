<?php
use Doctrine\DBAL\Schema\Table;

//$schema = new \Doctrine\DBAL\Schema\Schema();
$schema = $app['db']->getSchemaManager();
if (!$schema->tablesExist('users')) {
    $users = new Table('users');
    $users->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
    $users->addColumn('email', 'string', array('length' => 255));
    $users->setPrimaryKey(array('id'));
    $users->addUniqueIndex(array("email"));
    $schema->createTable($users);
}
$users = $schema->listTableDetails('users');

if (!$schema->tablesExist('jobs')) {
    $jobs = new Table('jobs');
    $jobs->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
    $jobs->addColumn('title', 'string', array('length' => 255));
    $jobs->addColumn('description', 'text');
    $jobs->addColumn('status', 'string', array('length' => 255));
    $jobs->addColumn('email', 'string', array('length' => 255));
    $jobs->addColumn('user_id', 'integer');
    $jobs->addForeignKeyConstraint(
        $users,
        array("user_id"),
        array("id"),
        array("onUpdate" => "CASCADE")
    );
    $schema->createTable($jobs);
}

echo "Database is ready!\n";
