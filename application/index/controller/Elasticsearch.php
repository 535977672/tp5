<?php
namespace app\index\controller;

//require '../vendor/autoload.php';

use think\Controller;
use Elasticsearch\ClientBuilder;

/**
    elasticsearch
    搜索引擎elasticsearch
    是一个基于Apache Lucene(TM)的开源搜索引擎。无论在开源还是专有领域，Lucene可以被认为是迄今为止最先进、性能最好的、功能最全的搜索引擎库。
    文档 https://es.xiaoleilu.com/index.html
    Github https://github.com/elastic/

    安装
    elasticsearch下载地址 https://www.elastic.co/cn/downloads/elasticsearch
    Run bin/elasticsearch (or bin\elasticsearch.bat on Windows 或者 service install service start)
    Run curl http://localhost:9200/

    Kibana，您能够对 Elasticsearch 中的数据进行可视化并在 Elastic Stack 进行操作。
    Kibana下载地址 https://www.elastic.co/cn/downloads/kibana
    config/kibana.yml 设置elasticsearch.hosts: ["http://localhost:9200"]
    Run bin/kibana (or bin\kibana.bat on Windows)
    Run http://localhost:5601


    Marvel是Elasticsearch的管理和监控工具，它包含了一个叫做Sense的交互式控制台，使用户方便的通过浏览器直接与Elasticsearch进行交互。
    Marvel 让你可以很简单的通过 Kibana 监控 Elasticsearch。你可以实时查看你的健康状态和性能，也可以分析过去的集群、索引和节点指标。
    从5.0版本开始，Marvel将成为X-Pack的一部分。
    X-Pack是一个Elastic Stack的扩展，将安全，警报，监视，报告和图形功能包含在一个易于安装的软件包中。在Elasticsearch 5.0之前，
    您必须安装单独的Shield，Watcher和Marvel插件才能获得在X-Pack中所有的功能。Elasticksearch，abana，每个节点都装x-pack。

    elasticsearch-php
    文档 https://www.elastic.co/guide/cn/elasticsearch/php/current/index.html

    索引(indexing)、搜索(search)以及聚合(aggregations)

    数据库和Elasticsearch对应
    Relational DB -> Databases -> Tables -> Rows -> Columns
    Elasticsearch -> Indices   -> Types  -> Documents -> Fields索引、类型、文档、字段
 */

/**
    查询结果
    array(4) {
      ["_scroll_id"] => string(104) "Dn。。。"
      ["took"] => int(4)
      ["timed_out"] => bool(false)
      ["_shards"] => array(4) {
        ["total"] => int(2)
        ["successful"] => int(2)
        ["skipped"] => int(0)
        ["failed"] => int(0)
      }
      ["hits"] => array(3) {
        ["total"] => array(2) {
          ["value"] => int(595)
          ["relation"] => string(2) "eq"
        }
        ["max_score"] => float(0.010794252)
        ["hits"] => array(10) {
          [0] => array(5) {
            ["_index"] => string(8) "my_index"
            ["_type"] => string(7) "my_type"
            ["_id"] => string(20) "heMfUGsB2Qg2MLGVCdLE"
            ["_score"] => float(0.010794252)
            ["_source"] => array(7) {
              ["pid"] => int(10000004)
              ["pint"] => int(123)
    _scroll_id 游标查询时的滚动id
    hits 响应中最重要的部分是hits，它包含了total字段来表示匹配到的文档总数
    _score 每个节点都有一个_score字段，这是相关性得分(relevance score)，它衡量了文档与查询的匹配程度。默认的，返回的结果中关联性最大的文档排在首位；
    max_score 指的是所有文档匹配查询中_score的最大值
    took 告诉我们整个搜索请求花费的毫秒数
    _shards节点告诉我们参与查询的分片数（total字段），有多少是成功的（successful字段），有多少的是失败的（failed字段）。
    time_out值告诉我们查询超时与否。一般的
*/           
                     
class Elasticsearch extends Controller
{
    
    private $client = null;

    public function initialize()
    { 
        $hosts = [
            'localhost:9200',
//            '192.168.1.1:9200',         // IP + Port
//            '192.168.1.2',              // Just IP
//            'mydomain.server.com:9201', // Domain + Port
//            'mydomain2.server.com',     // Just Domain
//            'https://localhost',        // SSL to localhost
//            'https://192.168.1.3:9200'  // SSL to IP + Port
        ];
        
        //连接池
        //客户端会维持一个连接池，连接池内每个连接代表集群的一个节点。这里有好几种连接池可供使用，每个的行为都有些细微差距。
        //连接池是客户端内的一个对象，主要是维持现有节点的连接。理论上来讲，节点只有死节点与活节点。
        $connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool';
        $connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool'; // 默认
        //连接池维持一个静态的 hosts 清单，这些 hosts 在客户端初始化时都被假定为活节点。
        $connectionPool = '\Elasticsearch\ConnectionPool\StaticConnectionPool';
        //StaticConnectionPool除了要在使用前 ping 节点来确定是否为活节点，其它的特性与 StaticNoPingConnectionPool 一致。
        $connectionPool = '\Elasticsearch\ConnectionPool\SimpleConnectionPool';
        //SimpleConnectionPool 仅仅返回选择器（Selector）指定的下个节点信息，它不监测节点的“生死状态”。不管节点是活节点还是死节点，
        //这种连接池都会返回节点信息给客户端。它仅仅是个简单的静态 host 连接池。
        $connectionPool = '\Elasticsearch\ConnectionPool\SniffingConnectionPool';
        //SniffingConnectionPool 与前面的两个静态连接池有所不同，它是动态的。用户提供 hosts 种子，而客户端则会嗅探这些 hosts 并发现集群的其余节点。 
        //SniffingConnectionPool 会每秒执行嗅探和 ping 所有节点 嗅探对于php常驻进程来说往往更加有用
        
        
        //选择器
        //连接池维持一份连接清单，它决定节点在什么时候从活节点转变为死节点（或死节点转变为活节点）。
        //然而连接池选择连接对象时是没有逻辑的，这份工作属于 Selector 类。
        //选择器（selector）的工作是从连接池数组中返回一个连接。和连接池一样，也有几种选择器可供选择。
        $selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector';
        $selector = '\Elasticsearch\ConnectionPool\Selectors\RoundRobinSelector'; // 默认
        //选择器通过轮询调度的方式来返回连接。
        $selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector'; //php
        //这个选择器具有“粘性”，它更喜欢重用同一个连接。
        //PHP 脚本是无共享架构且会快速退出，为每个请求创建新连接通常是一种次优策略且会引起大量的开销。
        //相反，在脚本运行期间“黏住”单个节点会更好。
        $selector = '\Elasticsearch\ConnectionPool\Selectors\RandomSelector';
        //这种选择器仅仅返回一个随机的节点，不管节点是处于什么状态。这个选择器通常用做测试。
        
        
        //序列化器
        //客户端有 3 种序列化器可用。你可能永远都不会更改序列化器，除非你有特殊需求或者要实现一个新的协议。
        //序列化器的工作是 encode 发送的请求体和 decode 返回的响应体。
        //在 99% 的例子中，这就是一种简单转换为JSON数据或解析 JSON 数据的工具。
        //客户端的请求数据是关联数组，但是 Elasticsearch 接受 JSON 数据。序列化器是指把 PHP 数组序列化为 JSON 数据。
        //当然 Elasticsearch 返回的 JSON 数据也会反序列化为 PHP 数组。
        $serializer = '\Elasticsearch\Serializers\SmartSerializer';
        
        
       //实例化一个客户端
       $this->client = ClientBuilder::create()
           
           ->setHosts($hosts) 
           //setHosts() 方法可以改变客户端的默认连接方式
           //setHosts() 方法接收一个一维数组，数组里面每个值都代表集群里面的一个节点信息
           
           //->setRetries(2) //客户端默认重连 n （n=节点数）次。
           //->setConnectionPool($connectionPool, [])
           //->setSelector($selector)
           //->setSerializer($serializer)
           
           ->build();
    }
    
    //索引一个文档编辑
    public function index() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            //'id' => 'my_id', //可以提供一个 ID 或者让 Elasticsearch 自动生成
            'body' => [
                'pid' =>100000001,
                'pint' => 123,
                'pstr' => 'strings',
                'pnum' => '121223.241432414132',
                'pjson' => json_encode([12,12,13,13,14,14]),
                'ptext' => 'this is my_index text 客户端构建文档实例 12130 6666 ok.',
                'pbool' => 1
                ]
        ];

        $response = $this->client->index($params);
        dump($response);
        //Array ( 
        //    [_index] => my_index 
        //    [_type] => my_type 
        //    [_id] => guMQUGsB2Qg2MLGVn9IX 
        //    [_version] => 1 
        //    [result] => created 
        //    [_shards] => Array ( 
        //        [total] => 1 
        //        [successful] => 1 
        //        [failed] => 0 
        //        ) 
        //    [_seq_no] => 0 
        //    [_primary_term] => 1 
        //    )
    }

    //批量（bulk）索引文档 
    //action 批量操作的行为
    //create	当文档不存在时创建之。
    //index	    创建新文档或替换已有文档。
    //update	局部更新文档。
    //delete	删除一个文档。
    public function indexMore() {
        $params['body'] = [];
        for ($i = 2; $i <= 100; $i++) {
            $params['body'][] = [
                'index' => [   #创建
                    '_index' => 'my_index',
                    '_type' => 'my_type',
                ]
            ];
            $params['body'][] = [
                'pid' =>10000000+$i,
                'pint' => 123,
                'pstr' => $this->getRandStr(10),
                'pnum' => '121223.241432414132_'.$i,
                'pjson' => json_encode([12,12,13,13,14,14]),
                'ptext' => 'this is my_index text 客户端构建文档实例 12130 6666 ok _' . $i .'.' . $this->getRandStr(10) ,
                'pbool' => 1,
                'time' => date('Y-m-d H:i:s')
                ];
        }
       
        $response = $this->client->bulk($params);
        dump($response);
    }
    
    //获取一个文档
    public function get() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'guMQUGsB2Qg2MLGVn9IX', //必须
            //'client' => [
                //'future' => 'lazy', 
                //异步方式批量发送请求 Future 模式有两个参数可选： true 或 lazy
                
                //'timeout' => 10,        //每个请求的 Curl 超时时间
                //'connect_timeout' => 10
                
                //'verbose' => true
                //客户端默认只返回响应体数据。如果你需要更多信息（如头信息、相应状态码等）。
                
                //'ignore' => [400, 404]
                //忽略 MissingDocument404Exception等异常 返回的是 Elasticsearch 提供的 JSON 数据
            //],
            
            //空对象处理
            //'body' => [
            //    //高亮
            //    'highlight' => array(
            //        'fields' => array(
            //            'content' => new \stdClass() //"content" : {} 空对象处理
            //        )
            //    )
            //],
        ];

        $response = $this->client->get($params);
        dump($response);
        //array(8) {
        //  ["_index"] => string(8) "my_index"
        //  ["_type"] => string(7) "my_type"
        //  ["_id"] => string(20) "guMQUGsB2Qg2MLGVn9IX"
        //  ["_version"] => int(2)
        //  ["_seq_no"] => int(156)
        //  ["_primary_term"] => int(1)
        //  ["found"] => bool(true)
        //  ["_source"] => array(8) {
        //    ["pid"] => int(100000001)
        //    ["pint"] => int(123)
        //    ["pstr"] => string(7) "strings"
        //    ["pnum"] => string(19) "121223.241432414132"
        //    ["pjson"] => string(19) "[12,12,13,13,14,14]"
        //    ["ptext"] => string(64) "this is my_index text 客户端构建文档实例 12130 6666 ok."
        //    ["pbool"] => int(2)
        //    ["pnew_field"] => string(14) "pnew_field abc"
        //  }
        //}        
    }
    
    //更新文档
    //更新文档操作既可以完全覆盖现存文档全部字段，又可以部分更新字段（更改现存字段，或添加新字段）。
    //部分更新
    //如果你要部分更新文档（如更改现存字段，或添加新字段），你可以在 body 参数中指定一个 doc 参数。
    //这样 doc 参数内的字段会与现存字段进行合并。
    //'body' => [
    //    'doc' => [
    //        'new_field' => 'abc'
    //    ]
    //]
    //
    //script脚本更新
    //'body' => [
    //    'script' => 'ctx._source.counter += count',
    //    'params' => [
    //        'count' => 4
    //    ]
    //] 
    //
    //Upserts更新
    //Upserts 操作是指“更新或插入”操作。这意味着一个 upsert 操作会先执行 script 更新，
    //如果文档不存在（或是你更新的字段不存在），则会插入一个默认值。
    //'body' => [
    //    'script' => 'ctx._source.counter += count',
    //    'params' => [
    //        'count' => 4
    //    ],
    //    'upsert' => [
    //        'counter' => 1
    //    ]
    //]    
    public function update() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'guMQUGsB2Qg2MLGVn9IX',
            'body' => [
                'doc' => [
                    'pnew_field' => 'pnew_field abc',
                    'pbool' => 2
                ]
            ]
        ];

        $response = $this->client->update($params);
        dump($response);
    }
    
    //搜索一个文档
    public function search() {
        $params = [
            //游标查询 Scroll
            //Scrolling 功能对文档进行分页处理
            //Scrolling 会保留某个时间点的索引快照数据，然后用快照数据进行分页。
            //返回一个文档“页数”信息，还有一个用来获取 hits 分页数据的 scroll_id
            //游标查询允许我们 先做查询初始化，然后再批量地拉取结果。 这有点儿像传统数据库中的 cursor 。
            //注意游标查询每次返回一个新字段 _scroll_id`。
            //每次我们做下一次游标查询， 我们必须把前一次查询返回的字段 `_scroll_id 传递进去。 
            //当没有更多的结果返回的时候，我们就处理完所有匹配的文档了
            //尽管我们指定字段 size 的值，我们有可能取到超过这个值数量的文档。
            "scroll" => "30s",//how long between scroll requests. should be small
            "size" => 5,//how many results *per shard* you want back
            "sort" => ["pid"],
            
            'index' => 'my_index',
            'type' => 'my_type',
//            'body' => [
//                'query' => [
//                    'match' => [
//                        'pstr' => 'strings'
//                    ]
//                ]
//            ]
        ];

        $response = $this->client->search($params);
        dump($response);
        
        //游标查询 Scroll
        while (isset($response['hits']['hits']) && count($response['hits']['hits']) > 0) {
            $scroll_id = $response['_scroll_id'];
            $response = $this->client->scroll([
                    "scroll_id" => $scroll_id,
                    "scroll" => "30s"
                ]
            );
            dump($response);
        }

        //array(5) {
        //  ["_scroll_id"] => string(104) "DnF1ZXJ5VGhlbkZldGNoAgAAAAAAAAhlFldER2ZTU1BOUmc2M0I4TldFdjRPVEEAAAAAAAAIZhZXREdmU1NQTlJnNjNCOE5XRXY0T1RB"
        //  ["took"] => int(1)
        //  ["timed_out"] => bool(false)
        //  ["_shards"] => array(4) {
        //    ["total"] => int(2)
        //    ["successful"] => int(2)
        //    ["skipped"] => int(0)
        //    ["failed"] => int(0)
        //  }
        //  ["hits"] => array(3) {
        //    ["total"] => array(2) {
        //      ["value"] => int(298)
        //      ["relation"] => string(2) "eq"
        //    }
        //    ["max_score"] => float(0.0035026306)
        //    ["hits"] => array(5) {
        //      [0] => array(5) {
        //        ["_index"] => string(8) "my_index"
        //        ["_type"] => string(7) "my_type"
        //        ["_id"] => string(20) "heMfUGsB2Qg2MLGVCdLE"
        //        ["_score"] => float(0.0035026306)
        //        ["_source"] => array(7) {
        //          ["pid"] => int(10000004)
        //          ["pint"] => int(123)
        //          ["pstr"] => string(7) "strings"
        //          ["pnum"] => string(21) "121223.241432414132_2"
        //          ["pjson"] => string(19) "[12,12,13,13,14,14]"
        //          ["ptext"] => string(67) "this is my_index text 客户端构建文档实例 12130 6666 ok _4."
        //          ["pbool"] => int(1)
        //        }
        //      }
    }
    
    //删除一个文档
    public function delete() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
        ];

        $response = $this->client->delete($params);
        dump($response);
    }
    
    //删除一个索引
    public function deleteIndex() {
        $deleteParams = [
            'index' => 'my_index'
        ];
        $response = $this->client->indices()->delete($deleteParams);
        dump($response);
    }
    
    //创建一个索引
    public function createIndex() {
        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];

        $response = $this->client->indices()
            ->create($params);
            //->putSettings($params); //更改索引的配置参数
            //->getSettings($params);//一个或多个索引的当前配置参数
            //->putMapping($params);//更改或增加一个索引的映射
            //getMapping($params);
        
        dump($response);
    }
    
    
    
    /**
     * 查询
     */
    
    public function searchCount() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
        ];

        $response = $this->client->count($params);
        dump($response);
        //array(2) {
        //  ["count"] => int(595)
        //  ["_shards"] => array(4) {
        //    ["total"] => int(2)
        //    ["successful"] => int(2)
        //    ["skipped"] => int(0)
        //    ["failed"] => int(0)
        //  }
        //}
             
    }
    
    //检索文档
    public function searchGet() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'guMQUGsB2Qg2MLGVn9IX'
        ];

        $response = $this->client->get($params);
        dump($response);
        //array(8) {
        //  ["_index"] => string(8) "my_index"
        //  ["_type"] => string(7) "my_type"
        //  ["_id"] => string(20) "guMQUGsB2Qg2MLGVn9IX"
        //  ["_version"] => int(2)
        //  ["_seq_no"] => int(156)
        //  ["_primary_term"] => int(1)
        //  ["found"] => bool(true)
        //  ["_source"] => array(8) {
        //    ["pid"] => int(100000001)
        //    ["pint"] => int(123)
        //    ["pstr"] => string(7) "strings"
        //    ["pnum"] => string(19) "121223.241432414132"
        //    ["pjson"] => string(19) "[12,12,13,13,14,14]"
        //    ["ptext"] => string(64) "this is my_index text 客户端构建文档实例 12130 6666 ok."
        //    ["pbool"] => int(2)
        //    ["pnew_field"] => string(14) "pnew_field abc"
        //  }
        //}        
    }
    
    //简单搜索
    /**
     * $params['index']                    = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     *        ['type']                     = (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     *        ['analyzer']                 = (string) The analyzer to use for the query string
     *        ['analyze_wildcard']         = (boolean) Specify whether wildcard and prefix queries should be analyzed (default: false)
     *        ['default_operator']         = (enum) The default operator for query string query (AND or OR)
     *        ['df']                       = (string) The field to use as default where no field prefix is given in the query string
     *        ['explain']                  = (boolean) Specify whether to return detailed information about score computation as part of a hit
     *        ['fields']                   = (list) A comma-separated list of fields to return as part of a hit
     *        ['from']                     = (number) Starting offset (default: 0)
     *        ['ignore_indices']           = (enum) When performed on multiple indices, allows to ignore `missing` ones
     *        ['indices_boost']            = (list) Comma-separated list of index boosts
     *        ['lenient']                  = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     *        ['lowercase_expanded_terms'] = (boolean) Specify whether query terms should be lowercased
     *        ['preference']               = (string) Specify the node or shard the operation should be performed on (default: random)
     *        ['q']                        = (string) Query in the Lucene query string syntax
     *        ['query_cache']              = (boolean) Enable query cache for this request
     *        ['request_cache']            = (boolean) Enable request cache for this request
     *        ['routing']                  = (list) A comma-separated list of specific routing values
     *        ['scroll']                   = (duration) Specify how long a consistent view of the index should be maintained for scrolled search
     *        ['search_type']              = (enum) Search operation type
     *        ['size']                     = (number) Number of hits to return (default: 10)
     *        ['sort']                     = (list) A comma-separated list of <field>:<direction> pairs
     *        ['source']                   = (string) The URL-encoded request definition using the Query DSL (instead of using request body)
     *        ['_source']                  = (list) True or false to return the _source field or not, or a list of fields to return
     *        ['_source_exclude']          = (list) A list of fields to exclude from the returned _source field (deprecated in ES 6.6.0)
     *        ['_source_include']          = (list) A list of fields to extract and return from the _source field (deprecated in ES 6.6.0)
     *        ['_source_excludes']         = (list) A list of fields to exclude from the returned _source field
     *        ['_source_includes']         = (list) A list of fields to extract and return from the _source field
     *        ['stats']                    = (list) Specific 'tag' of the request for logging and statistical purposes
     *        ['suggest_field']            = (string) Specify which field to use for suggestions
     *        ['suggest_mode']             = (enum) Specify suggest mode
     *        ['suggest_size']             = (number) How many suggestions to return in response
     *        ['suggest_text']             = (text) The source text for which the suggestions should be returned
     *        ['timeout']                  = (time) Explicit operation timeout
     *        ['terminate_after']          = (number) The maximum number of documents to collect for each shard, upon reaching which the query execution will terminate early.
     *        ['version']                  = (boolean) Specify whether to return document version as part of a hit
     *        ['body']                     = DSL语言查询
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     */
    public function searchSearch() {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'from' => 0,
            'size' => 10,
            //'explain' => true,  //分析控制 
            
            
            
            //DSL查询
            'body' => [
                'sort' => [
                    'pint' => 'desc',
                    'pid' => 'desc',
                    '_score' => 'desc'
                ],
                
//                //term主要用于精确匹配哪些值，
//                //比如数字，日期，布尔值或 not_analyzed 的字符串(未经切词的文本数据类型)
//                //只能一个字段
//                'term' => [
//                    'pnum' => '121223.241432414132'
//                ],
//
//                //terms 跟 term 有点类似，但 terms 允许指定多个匹配条件。 
//                //如果某个字段指定了多个值，那么文档需要一起去做匹配
//                'terms' => [
//                    'pnum' => ['121223.241432414132', '121223.241432414132']
//                ],
//
//                //range 过滤 允许我们按照指定范围查找一批数据
//                //gt gte lt lte
//                'range' => [
//                    'pnum' => [
//                        'gt' => 121223,
//                        'lt' => 121224
//                    ]
//                ],
//
//                //exists 和 missing 过滤
//                //可以用于查找文档中是否包含指定字段或没有某个字段，类似于SQL语句中的IS_NULL条件.
//                //只是针对已经查出一批数据来，但是想区分出某个字段是否存在的时候使用
//                'range' => [
//                    'exists' => [
//                        'pnum' => 121223
//                    ]
//                ],
//
//                //bool 过滤可以用来合并多个过滤条件查询结果的布尔逻辑，它包含一下操作符：
//                //must :: 多个查询条件的完全匹配,相当于 and。
//                //must_not :: 多个查询条件的相反匹配，相当于 not。
//                //should :: 至少有一个查询条件匹配, 相当于 or。
//                'bool' => [
//                    'must' => [
//                        'term' => [
//                            'pnum' => '121223.241432414132'
//                        ],
//                    ],
//                    'must_not' => [
//                        'term' => [
//                            'pnum' => '121223.241432414132'
//                        ],
//                    ],
//                    'should' => [
//                        'term' => [
//                            'pnum' => '121223.241432414132'
//                        ],
//                        'term' => [
//                            'pnum' => '121223.241432414132'
//                        ],
//                    ],
//                ],
                 
                'query' => [                                
                    
                    
                    
//                    //组合查询
//                    //bool 查询与 bool 过滤相似，用于合并多个查询子句。
//                    //不同的是，bool 过滤可以直接给出是否匹配成功， 
//                    //而bool 查询要计算每一个查询子句的 _score （相关性分值）。
//                    //must:: 查询指定文档一定要被包含。
//                    //must_not:: 查询指定文档一定不要被包含。
//                    //should:: 查询指定文档，有则可以为文档相关性加分。
//                    'bool' => [
//                        'must' => [
//                            'term' => [ //只能一个字段
//                                'pstr' => 'strings'
//                            ],
//                        ],
//                        'must_not' => [
//                            'term' => [
//                                'pnum' => '121223.241432414132'
//                            ],
//                        ],
//                        'should' => [
//                            'term' => [
//                                'pnum' => '121223.241432414132'
//                            ],
//                            'term' => [
//                                'pstr' => 'strings'
//                            ],
//                        ],
//                        //minimum_should_match参数控制多少should子句需要被匹配，这个参数可以是正整数，也可以是百分比。
//                        "minimum_should_match" => 2
//                    ],
//                    
//                    //多词查询 匹配查询
//                    //"match_all": {} 查询 查询到所有文档，是没有查询条件下的默认语句
//                    //match查询是一个标准查询，不管你需要全文本查询还是精确查询基本上都要用到它
//                    //提示： 做精确匹配搜索时，你最好用过滤语句，因为过滤语句可以缓存数据。
//                    //完全匹配 一个字段
//                    'match' => [
//                        'pnum' => '121223.241432414132',
//                    ],                    
                    'match' => [
                        //至少包含一个匹配的结果
                        'ptext' => 'my_index 户端 构 建文 ok _4',
                    ],
//                    'match' => [
//                        'ptext' => [
//                            'query' => 'my_index 户端 构 建文 ok _4',
//                            //包含所有匹配的结果
//                            'operator' => 'and', //默认 or
//                            //'minimum_should_match'参数，参数值表示被视为相关的文档必须匹配的关键词个数
//                            //介于operator and or之间
//                            //'minimum_should_match' => '8' //整数、百分百 
//                            ],
//                    ],
//                    
//                    //multi_match查询允许你做match查询的基础上同时搜索多个字段，在多个字段中同时查一个
//                    //pnum 或者 pstr 等于 query
//                    'multi_match' => [
//                        'query' => '121223.241432414132',
//                        'fields' => [
//                            'pnum','pstr'
//                        ]
//                    ],
//                    
//                    //wildcards 查询 使用标准的shell通配符查询   
//                    
//                    //regexp 查询 一个字段
//                    'regexp' => [
//                        'pnum' => '[0-9\._]+'
//                    ],
//                    
//                    //prefix 前缀查询 一个字段
//                    'prefix' => [
//                        'pnum' => '121223'
//                    ],
//                    
//                    //短语匹配(Phrase Matching)
//                    //match_phrase查询首先解析查询字符串来产生一个词条列表。然后会搜索所有的词条，
//                    //但只保留含有了所有搜索词条的文档，并且词条的位置要邻接。
//                    'match_phrase' => [
//                        'ptext' => 'is my_index text 客户端构建文' //is my_index tex将搜索不到数据
//                    ],
                ]
            ],
        ];

        $response = $this->client->search($params);
        dump($response);      
    }
    
    
    
    public function getRandStr($length = 10, $type = 1){
        if ($type == 1) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST0123456789';
        } else if ($type == 2) {
            $chars = 'abcdefghijklmnopqrstuvwxyz';
        } else if ($type == 3) {
            $chars = '0123456789';
        }
        $len = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $len - 1)];
        }
        return $str;
    }
}


