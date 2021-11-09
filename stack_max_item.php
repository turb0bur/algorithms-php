<?php

class StackWithMax
{
    protected $stack = [];

    protected $maxStack = [];

    public function push($item)
    {
        $this->stack[] = $item;
        $lastIndex = count($this->maxStack) - 1;
        if ($lastIndex !== -1 && ($lastMaxItem = $this->maxStack[$lastIndex]) > $item) {
            $this->maxStack[] = $lastMaxItem;
        } else {
            $this->maxStack[] = $item;
        }
    }

    public function pop()
    {
        array_pop($this->maxStack);

        return array_pop($this->stack);
    }

    public function getMax()
    {
        return $this->maxStack[count($this->maxStack) - 1];
    }
}
/*
 * Complete the 'getMax' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts STRING_ARRAY operations as parameter.
 */

function getMax($operations) {
    $stack = new StackWithMax();
    $result = [];
    foreach ($operations as $operation) {
        $operationData = explode(' ', $operation);
        switch ($operationData[0]):
            case '1':
                $stack->push($operationData[1]);
                break;
            case '2':
                $stack->pop();
                break;
            case '3':
                $result[] = $stack->getMax();
                break;
            default:
                echo 'Unknown operation';
        endswitch;
    }

    return $result;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$n = intval(trim(fgets(STDIN)));

$ops = array();

for ($i = 0; $i < $n; $i++) {
    $ops_item = rtrim(fgets(STDIN), "\r\n");
    $ops[] = $ops_item;
}

$res = getMax($ops);

fwrite($fptr, implode("\n", $res) . "\n");

fclose($fptr);
