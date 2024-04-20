<?php


class Comment
{

    private static ?Comment $instance = null;

    private $comments = array();

    private function __construct() {}

    public static function getInstance(): Comment
    {
        if (self::$instance === null) {
            self::$instance = new Comment();
        }
        return self::$instance;
    }

    public function addComment($id, $parentId, $comment) {
        // Сохраняем id комментария вместе с другими данными
        $this->comments[$id] = array('id' => $id, 'parent' => $parentId, 'comment' => $comment);
    }

    public function buildTreeForHtml() {
        $html = "";

        $rootComments = array_filter($this->comments, function($comment) {
            return $comment['parent'] == $comment['id'];
        });

        foreach ($rootComments as $comment) {
            $html .= $this->buildSubTree($comment, 0);
        }

        return $html;
    }

    private function buildSubTree($comment, $depth) {//Вспомогательный метод
        $html = str_repeat("&emsp;", $depth) . $comment['comment'] . "<br>";

        $childComments = array_filter($this->comments, function($c) use ($comment) {
            return $c['parent'] == $comment['id'] && $c['id'] != $comment['id'];
        });

        foreach ($childComments as $childComment) {
            $html .= $this->buildSubTree($childComment, $depth + 1);
        }
        return $html;
    }
}

$commentTree = Comment::getInstance();

$comments = [
    [1, 1, "Comment 1"],
    [2, 1, "Comment 2"],
    [3, 2, "Comment 3"],
    [4, 1, "Comment 4"],
    [5, 2, "Comment 5"],
    [6, 3, "Comment 6"],
    [7, 7, "Comment 7"]
];

foreach ($comments as $comment){
    list($id, $parentId, $comment) = $comment;

    $commentTree->addComment($id, $parentId, $comment);
}

echo $commentTree->buildTreeForHtml();