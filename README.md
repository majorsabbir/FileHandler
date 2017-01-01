# FileHandler
<p>How to use FileCopy Library</p>
<pre>
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
use FileHandler\src\FileCopy as FC;

$Obj = new FC;
$Obj->setLocalDir('box');
$arr = []; // full path with file name goes here as array
$Obj->setSourceFile($arr);

$Obj->save();

print("<pre>");
print_r($x->getResult());
</pre>
