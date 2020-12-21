<?php

/**
 * 将两个升序链表合并为一个新的 升序 链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。 
 * 示例：
 *
 * 输入：1->2->4, 1->3->4
 * 输出：1->1->2->3->4->4
 *
 * 来源：力扣（LeetCode）
 * 链接：https://leetcode-cn.com/problems/merge-two-sorted-lists
 * 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 */


/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2) {
        $newListNode = new ListNode();//头结点
        //临时链表每次比较之后需要指向下一个结点
        $tmpNode = $newListNode;
        while ($l1 != null && $l2 != null) {
            if ($l1->val < $l2->val) {
                $tmpNode->next = $l1;
                $l1 = $l1->next;
            } else {
                $tmpNode->next = $l2;
                $l2 = $l2->next;
            }
            $tmpNode = $tmpNode->next;
        }
        $tmpNode->next = $l1 == null ? $l2 : $l1;
        return $newListNode->next;
    }
}