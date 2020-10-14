<?php

class Node
{
    public $value;
    public $left = null;
    public $right = null;
    public $isRed = true;
    public $parent = null;

    public function __construct($val)
    {
        $this->value = $val;
    }
}

class BinaryTree
{
    public $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function add($int)
    {
        $node = new Node($int);

        if (empty($this->root)) {
            $node->isRed = false;
            $this->root = $node;
        } else {
            $this->addNode($node, $this->root);
            $this->balancingInsert($node);
        }

    }

    public function addNode($node, &$subTree, &$parent = null)
    {
        if (empty($subTree)) {
            $node->parent = $parent;
            $subTree = $node;
        } else {
            if ($node->value <= $subTree->value) {
                $this->addNode($node, $subTree->left, $subTree);
            } else {
                $this->addNode($node, $subTree->right, $subTree);
            }
        }
    }

    public function delNode($value)
    {
        try {
            $node = &$this->findNode($value, $this->root);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (empty($node->left) && empty($node->right)) {
            $node = null;
            return;
        }

        if (empty($node->left)) {
            $node = $node->right;
            return;
        }
        if (empty($node->right)) {
            $node = $node->left;
            return;
        }

        $delNode = &$this->findLeftNode($node->right);
        $node->value = $delNode->value;
        $delNode = $delNode->right ?? null;
    }

    public function bypassLNR($node)
    {
        if (empty($node)) return;
        $this->bypassLNR($node->left);
        echo $this->addRed($node);
        $this->bypassLNR($node->right);
    }

    public function bypassLRN($node)
    {
        if (empty($node)) return;
        $this->bypassLRN($node->left);
        $this->bypassLRN($node->right);
        echo $this->addRed($node);
    }

    public function bypassNLR($node)
    {
        if (empty($node)) return;
        echo $this->addRed($node);
        $this->bypassNLR($node->left);
        $this->bypassNLR($node->right);
    }

    private function &findNode($value, &$subTree)
    {
        if (empty($subTree)) throw new Exception("Элемент не найден");
        if ($value === $subTree->value) return $subTree;

        if ($value < $subTree->value) {
            return $this->findNode($value, $subTree->left);
        } else {
            return $this->findNode($value, $subTree->right);
        }
    }

    private function &findLeftNode(&$node)
    {
        if (empty($node->left)) return $node;
        return $this->findLeftNode($node->left);
    }

    private function balancingInsert(&$node)
    {
        if (!$node->parent->isRed) return;

        while ($node !== $this->root && $node->parent->isRed) {
            if ($node->parent->parent->left === $node->parent) {
                $uncle = &$node->parent->parent->right;
            } else {
                $uncle = &$node->parent->parent->left;
            }

            if ($uncle->isRed) {
                $node->parent->isRed = false;
                $uncle->isRed = false;
                $node->parent->parent->isRed = true;
                $node = &$node->parent->parent;
            } else {
                if ($node->parent === $node->parent->parent->left) {
                    if ($node === $node->parent->right) {
                        $node = &$node->parent;
                        $this->smallLeftRotate($node);
                    }
                    $node->parent->isRed = false;
                    $node->parent->parent->isRed = true;
                    $this->rightRotate($node->parent->parent);
                } else {
                    if ($node === $node->parent->left) {
                        $node = &$node->parent;
                        $this->smallRightRotate($node);
                    }
                    $node->parent->isRed = false;
                    $node->parent->parent->isRed = true;
                    $this->leftRotate($node->parent->parent);
                }
            }
        }
        $this->root->isRed = false;
    }

    private function balancingDelete(&$node)
    {

    }

    private function leftRotate(&$node)
    {
        $right = &$node->right;

        $node->right = &$right->left;
        if (!empty($node->parent)) {
            if ($node->parent->left === $node) {
                $node->parent->left = $right;
            } else {
                $node->parent->right = $right;
            }
        } else {
            $this->root = &$right;
        }
        $right->parent = &$node->parent;
        $right->left = &$node;
        $node->parent = &$right;
    }

    private function rightRotate(&$node)
    {
        $left = &$node->left;

        $node->left = &$left->right;
        if (!empty($node->parent)) {
            if ($node->parent->left === $node) {
                $node->parent->left = $left;
            } else {
                $node->parent->right = $left;
            }
        } else {
            $this->root = &$left;
        }
        $left->parent = &$node->parent;
        $left->right = &$node;
        $node->parent = &$left;
    }

    private function smallLeftRotate(&$node)
    {
        $right = &$node->right;
        $right->parent = &$node->parent;
        $node->right = &$node->right->left;
        $right->right = &$node;
        $node->parent->left = &$right;
    }

    private function smallRightRotate(&$node)
    {
        $left = &$node->left;
        $left->parent = &$node->parent;
        $node->left = &$node->left->right;
        $left->right = &$node;
        $node->parent->right = &$left;
    }

    private function addRed(&$node)
    {
        return $node->isRed
            ? '<span style="color:red;"> ' . $node->value . ' </span>'
            : '<span style="color:black;"> ' . $node->value . ' </span>';
    }
}

$tree = new BinaryTree();
$tree->add(15);
$tree->add(13);
$tree->add(3);
$tree->add(25);
$tree->add(14);
$tree->add(21);
$tree->add(12);
$tree->add(16);
$tree->add(18);
$tree->add(32);

$tree->bypassLNR($tree->root);
