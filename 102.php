<?php
/**
 *
 * 给你一个二叉树，请你返回其按 层序遍历 得到的节点值。 （即逐层地，从左到右访问所有节点）。

 

示例：
二叉树：[3,9,20,null,null,15,7],

3
/ \
9  20
/  \
15   7
返回其层序遍历结果：

[
[3],
[9,20],
[15,7]
]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/binary-tree-level-order-traversal
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
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
    function levelOrder($root) {
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

        foreach ($arr as $val) {
            $val->left && $nodeList[] = $val->left;
            $val->right && $nodeList[] = $val->right;
            $res[$level][] = $val->val;
        }
        return $nodeList;
    }
}
