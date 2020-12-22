<?php
/**
 *
 * 给定一个二叉树，返回其节点值的锯齿形层序遍历。（即先从左往右，再从右往左进行下一层遍历，以此类推，层与层之间交替进行）。

例如：
给定二叉树 [3,9,20,null,null,15,7],

3
/ \
9  20
/  \
15   7
返回锯齿形层序遍历如下：

[
[3],
[20,9],
[15,7]
]

链接：https://leetcode-cn.com/problems/binary-tree-zigzag-level-order-traversal
 */

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function zigzagLevelOrder($root) {
        $res = [];
        $level = 0;//从0开始，树层级
        //tmp 该层所有的节点
        $tmp = empty($root) ? [] : [$root];
        while (!empty($tmp)) {
            $tmp = $this->getLevelNode($tmp, $level, $res);
            $level++;
        }
        return $res;
    }

    /*
    *  用上一层节点来获取下一层所有节点，返回下层节点组成的数组
    *  同时存放该层所有节点的val
    */
    function getLevelNode($arr, $level, &$res)
    {
        if (empty($arr)) {
            return [];
        }
        $nodeList = [];
        $res[$level] = [];
        foreach ($arr as $val) {
            $val->left && $nodeList[] = $val->left;
            $val->right && $nodeList[] = $val->right;
            if ($level%2 == 0) {//偶数层push
                array_push($res[$level], $val->val);
            } else {
                array_unshift($res[$level], $val->val);
            }

        }
        return $nodeList;
    }
}