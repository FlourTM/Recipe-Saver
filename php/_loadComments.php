<?php
session_start();
$recipeId = $_SESSION['current_recipe_id'];
$mysqli = require __DIR__ . '/database.php';
$commentsql = sprintf(
    "SELECT comments.content, comments.date, user.firstName, user.lastName
     FROM comments
     INNER JOIN user ON comments.userID = user.id
     WHERE comments.recipeID = %s",
    $mysqli->real_escape_string($recipeId)
);
$commentresult = $mysqli->query($commentsql);
$comments = array();
if ($commentresult->num_rows > 0) {
    while ($comment = $commentresult->fetch_assoc()) {
        $comments[] = $comment;
    }
}

if (!empty($comments)) {
    $comments = array_reverse($comments);
    foreach ($comments as $comment) { ?>
        <div class="flex gap-8">
            <div class="whitespace-nowrap">
                <p id="name" class="text-accentPink"><?= $comment['firstName'] . ' ' . $comment['lastName'] ?></p>
                <p id="date" class="text-sm"><?= date('M j, Y', strtotime($comment['date'])) ?></p>
            </div>
            <p id="comment"><?= $comment['content'] ?></p>
        </div>
    <?php }
} else { ?>
    <p class="text-center">Be the first to comment.</p>
<?php } ?>