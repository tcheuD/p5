/*php
require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function addAccountPage(array $request = []){
    if (isset($_POST["nickname"], $_POST["users_group"], $_POST["password"],
            $_POST["passwordConfirmation"], $_POST["email"]))
    {


        if ($_POST["password"] === $_POST["passwordConfirmation"]) {
            $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $status = addAccount($_POST["nickname"], $_POST["users_group"] ,$pass, $_POST["email"]);
        }
    }
    require loadTemplate('addAccount.php');
}

function editAccount(array $params, array $request = [])
{
    $id = $params[0];
    $account = getAccount($id);

    if(isset($account['nickname'])){
        $postTitle = htmlspecialchars($account['nickname']);
    } else $postTitle = "";

    if(isset($account['email'])){
        $postContent = htmlspecialchars($account['email']);
    } else $postContent = "";


    if (isset($_POST["title"], $_POST["content"])) {
        $status = editAccount($_POST['title'], $_POST['content'], $id);
    }

    require loadTemplate('editAccount.php');
}

function deleteAccount(){

}*/