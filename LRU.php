<?php


/**
 * LRU算法
 * 构造一个双向链表（双向链表删除尾部节点的上一个元素时间复杂度为O(1)）
 */
class LRUCache
{

    //头部节点
    private $head;

    //尾部节点
    private $tail;

    //最大容量，大于淘汰尾部节点指向的上一个元素
    private $capacity;

    //存放key对应的节点 key => node
    private $hashmap;

    /**
     * 初始化头部尾部节点
     * LRUCache constructor.
     * @param $capacity
     */
    public function __construct($capacity)
    {
        $this->capacity = $capacity;
        $this->hashmap = array();
        $this->head = new Node(null, null);
        $this->tail = new Node(null, null);
        //头结点右指针指向尾结点
        $this->head->setNext($this->tail);
        //尾结点左指针指向头结点
        $this->tail->setPrevious($this->head);
    }

    /**
     * 获取元素
     * @param $key
     * @return null
     */
    public function get($key)
    {

        if (!isset($this->hashmap[$key])) {
            return null;
        }

        $node = $this->hashmap[$key];
        if (count($this->hashmap) == 1) {
            return $node->getData();
        }

        //先删除已经存在的结点
        $this->detach($node);
        //重新将新结点插入到头结点之后
        $this->attach($this->head, $node);

        return $node->getData();
    }

    /**
     * 设置key value
     * @param $key
     * @param $data
     * @return bool
     */
    public function put($key, $data)
    {
        if ($this->capacity <= 0) {
            return false;
        }
        if (isset($this->hashmap[$key]) && !empty($this->hashmap[$key])) {
            $node = $this->hashmap[$key];
            //重置结点到头结点之后
            $this->detach($node);
            $this->attach($this->head, $node);
            $node->setData($data);
        } else {
            $node = new Node($key, $data);
            $this->hashmap[$key] = $node;
            //添加节点到头部节点之后
            $this->attach($this->head, $node);
            //检测容量是否达到最大值
            if (count($this->hashmap) > $this->capacity) {
                //如果达到最大值 删除尾节点左指针指向的元素
                $nodeToRemove = $this->tail->getPrevious();
                $this->detach($nodeToRemove);
                unset($this->hashmap[$nodeToRemove->getKey()]);
            }
        }
        return true;
    }


    /**
     * 删除key
     * @param $key
     * @return bool
     */
    public function remove($key)
    {
        if (!isset($this->hashmap[$key])) {
            return false;
        }
        $nodeToRemove = $this->hashmap[$key];
        $this->detach($nodeToRemove);
        unset($this->hashmap[$nodeToRemove->getKey()]);
        return true;
    }


    /**
     * 添加新结点到头结点之后
     * @param $head
     * @param $node
     */
    private function attach($head, $node)
    {
        //双向链表插入一个元素到头结点之后
        $node->setPrevious($head);
        $node->setNext($head->getNext());
        $node->getNext()->setPrevious($node);
        $node->getPrevious()->setNext($node);
    }


    /**
     * 删除结点
     * @param $node
     */
    private function detach($node)
    {
        $node->getPrevious()->setNext($node->getNext());
        $node->getNext()->setPrevious($node->getPrevious());
    }

}

/**
 * 结点数据结构
 */
class Node
{

    private $key;

    //key对应的内容
    private $data;

    //结点右指针
    private $next;

    //结点左指针
    private $previous;

    /**
     * Node constructor.
     * @param $key
     * @param $data
     */
    public function __construct($key, $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    /**
     * Sets a new value for the node data
     * @param string the new content of the node
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Sets a node as the next node
     * @param Node $next the next node
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * Sets a node as the previous node
     * @param Node $previous the previous node
     */
    public function setPrevious($previous)
    {
        $this->previous = $previous;
    }

    /**
     * Returns the node key
     * @return string the key of the node
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Returns the node data
     * @return mixed the content of the node
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the next node
     * @return Node the next node of the node
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Returns the previous node
     * @return Node the previous node of the node
     */
    public function getPrevious()
    {
        return $this->previous;
    }

}

$cache = new LRUCache(10);
$cache->put('myKey', 'myValue');
echo $cache->get('myKey');