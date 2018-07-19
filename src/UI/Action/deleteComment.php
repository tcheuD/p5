<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deleteCommentPage(array $params, array $request = []) {

    $id = $params[0];
    if (isset($id)) {
        $comment = getComment($id);
        if(isset($_SESSION['id'], $comment['user_id'])) {
            if ($_SESSION['id'] == $comment['user_id']) {
                $status = deleteComment($id);
                ?>
<script type="text/javascript">
    window.location.href = '../post/<?=$comment["post_id"]?>';
</script>
<?php
            }
        } else {
            echo "vous n\'avez pas les droits nécessaires pour supprimer ce post";
        }
    }

    require loadTemplate('deleteComment.php');
}
?>
