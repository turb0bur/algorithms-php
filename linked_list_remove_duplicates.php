<?php

class SinglyLinkedListNode
{
    public $data;
    public $next;

    public function __construct($node_data)
    {
        $this->data = $node_data;
        $this->next = null;
    }
}

class SinglyLinkedList
{
    public $head;
    public $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    public function insertNode($node_data)
    {
        $node = new SinglyLinkedListNode($node_data);

        if (is_null($this->head)) {
            $this->head = $node;
        } else {
            $this->tail->next = $node;
        }

        $this->tail = $node;
    }
}

function printSinglyLinkedList($node, $sep)
{
    while (! is_null($node)) {
//        fwrite($fptr, $node->data);
        echo $node->data;

        $node = $node->next;

        if (! is_null($node)) {
//            fwrite($fptr, $sep);
            echo $sep;
        }
    }
}

/*
 * Complete the 'removeDuplicates' function below.
 *
 * The function is expected to return an INTEGER_SINGLY_LINKED_LIST.
 * The function accepts INTEGER_SINGLY_LINKED_LIST llist as parameter.
 */

/*
 * For your reference:
 *
 * SinglyLinkedListNode {
 *     int data;
 *     SinglyLinkedListNode next;
 * }
 *
 */

function removeDuplicates($llist)
{
    $currentNode = $llist;
    while ($currentNode) {
        $nextNode = $currentNode->next;
        while ($currentNode->next && $currentNode->data == $nextNode->data) {
            $nextNode = $nextNode->next;
        }
        $currentNode->next = $nextNode;
        $currentNode = $nextNode;
    }

    return $llist;
}

//$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen('php://stdin', 'r');

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $llist = new SinglyLinkedList();

    fscanf($stdin, "%d\n", $llist_count);

    for ($i = 0; $i < $llist_count; $i++) {
        fscanf($stdin, "%d\n", $llist_item);
        $llist->insertNode($llist_item);
    }

    $llist1 = removeDuplicates($llist->head);

    printSinglyLinkedList($llist1, ' ');
//    fwrite($fptr, "\n");
    echo PHP_EOL;
}

fclose($stdin);
//fclose($fptr);
