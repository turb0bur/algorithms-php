<?php

class SinglyLinkedListNode {
    public $data;
    public $next;

    public function __construct($node_data)
    {
        $this->data = $node_data;
        $this->next = null;
    }
}

class SinglyLinkedList {
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

function printSinglyLinkedList($node, $sep, $fptr)
{
    while (!is_null($node)) {
        fwrite($fptr, $node->data);

        $node = $node->next;

        if (!is_null($node)) {
            fwrite($fptr, $sep);
        }
    }
}

/*
 * Complete the 'insertNodeAtPosition' function below.
 *
 * The function is expected to return an INTEGER_SINGLY_LINKED_LIST.
 * The function accepts following parameters:
 *  1. INTEGER_SINGLY_LINKED_LIST llist
 *  2. INTEGER data
 *  3. INTEGER position
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

function insertNodeAtPosition($llist, $data, $position) {
    $currentNode = $llist->next;
    for ($i = 1; $i < $position; $i++) {
        if ($i == $position - 1) {
            $nodeToBeInserted = new SinglyLinkedListNode($data);
            if ($nextNode = $currentNode->next) {
                $nodeToBeInserted->next = $nextNode;
            } else {
                $llist->tail = $nodeToBeInserted;
            }
            $currentNode->next = $nodeToBeInserted;
        }
        $currentNode = $currentNode->next;
    }

    return $llist;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

$llist = new SinglyLinkedList();

fscanf($stdin, "%d\n", $llist_count);

for ($i = 0; $i < $llist_count; $i++) {
    fscanf($stdin, "%d\n", $llist_item);
    $llist->insertNode($llist_item);
}

fscanf($stdin, "%d\n", $data);

fscanf($stdin, "%d\n", $position);

$llist_head = insertNodeAtPosition($llist->head, $data, $position);

printSinglyLinkedList($llist_head, " ", $fptr);
fwrite($fptr, "\n");

fclose($stdin);
fclose($fptr);
