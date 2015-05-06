<?php

use App\Article;
use App\Repositories\ArticleRepository;

// 一樣要先繼承
class ArticleRepositoryTest extends TestCase
{
    /**
     * @var ArticleRepository
     */
    protected $repository = null;

    /**
     * 建立 100 筆假文章
     */
    protected function seedData()
    {
        for ($i = 1; $i <= 100; $i ++) {
            Article::create([
                'title' => 'title ' . $i,
                'body'  => 'body ' . $i,
            ]);
        }
    }

    // 跟前面一樣，每次都要初始化資料庫並重新建立待測試物件
    // 以免被其他 test case 影響測試結果
    public function setUp()
    {
        parent::setUp();

        $this->initDatabase();
        $this->seedData();

        // 建立要測試用的 repository
        $this->repository = new ArticleRepository();
    }

    public function tearDown()
    {
        $this->resetDatabase();
        $this->repository = null;
    }

    public function testFetchLatest10Articles()
    {
        // 從 repository 中取得最新 10 筆文章
        $articles = $this->repository->latest10();
        $this->assertEquals(10, count($articles));

        // 確認標題是從 100 .. 91 倒數
        // "title 100" .. "title 91"
        $i = 100;
        foreach ($articles as $article) {
            $this->assertEquals('title ' . $i, $article->title);
            $i -= 1;
        }
    }
}
