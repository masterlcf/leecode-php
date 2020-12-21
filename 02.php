<?php

/*给出两个 非空 的链表用来表示两个非负的整数。其中，它们各自的位数是按照 逆序 的方式存储的，并且它们的每个节点只能存储 一位 数字。

如果，我们将这两个数相加起来，则会返回一个新的链表来表示它们的和。

您可以假设除了数字 0 之外，这两个数都不会以 0 开头。

示例：

输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
输出：7 -> 0 -> 8
原因：342 + 465 = 807
来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/two-sum
    */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution
{

    private $res = 0;

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $add = 0;
        $obj = null;
        do {
            $val = $l1->val + $l2->val + $add;

            if ($val >= 10) {
                $val = $val % 10;
                $add = 1;
            } else {
                $add = 0;
            }

            $l3 = new ListNode($val);
            if (is_null($obj)) {
                $obj = $l3;
            } else {
                $next->next = $l3;
            }
            $next = $l3;
            $l1 = $l1->next;
            $l2 = $l2->next;
        } while ($l1 || $l2 || $add);
        return $obj;
    }

    function addTwoNumbers1($l1, $l2)
    {
        $node = new ListNode($this->res + $l1->val + $l2->val);
        if ($this->res = intval($node->val > 9)) {
            $node->val -= 10;
        }
        $node->next = (!$this->res && is_null($l1->next) && is_null($l2->next)) ? null : $this->addTwoNumbers1($l1->next, $l2->next);
        return $node;
    }
}