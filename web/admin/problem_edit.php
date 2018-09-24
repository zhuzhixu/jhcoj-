<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Edit Problem</title>
  <link rel="stylesheet" href="../font/style.css" />
  <link rel="stylesheet" href="../template/bs3/bootstrap.min.css" />
  <link rel="stylesheet" href="../template/bs3/bootstrap-theme.min.css" />
 

  
  <style>
    #changeDifficulty>span{
      margin-left:-4px;
      
    }

    #changeDifficulty{
      display: inline-block;
    }

    .tag{
      cursor: pointer;
    }
  </style>
</head>
<hr>

<?php
require_once("../include/db_info.inc.php");
require_once("admin-header.php");
require_once("../include/my_func.inc.php");
if(!(isset($_SESSION[$OJ_NAME.'_'.'administrator']) || isset($_SESSION[$OJ_NAME.'_'.'problem_editor']))){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
exit(1);
}
echo "<center><h3>Edit-"."$MSG_PROBLEM</h3></center>";
include_once("kindeditor.php") ;
?>

<body leftmargin="30" >
  <div class="container">
    <?php
    if(isset($_GET['id'])){
      ;//require_once("../include/check_get_key.php");
    ?>

    <form method=POST action=problem_edit.php>
      <?php
      $sql="SELECT * FROM `problem` WHERE `problem_id`=?";
      $result=pdo_query($sql,intval($_GET['id']));
      $row=$result[0];
      ?>

      <input type=hidden name=problem_id value='<?php echo $row['problem_id']?>'>
        <p align=left>
          <center><h3>
          <?php echo $row['problem_id']?>: <input class="input input-xxlarge" style='width:90%' type=text name=title value='<?php echo htmlentities($row['title'],ENT_QUOTES,"UTF-8")?>'>
          </h3></center>
        </p>
        <p align=left>
          <?php echo $MSG_Time_Limit?><br>
          <input class="input input-mini" type=text name=time_limit size=20 value='<?php echo htmlentities($row['time_limit'],ENT_QUOTES,"UTF-8")?>'> Sec<br><br>
          <?php echo $MSG_Memory_Limit?><br>
          <input class="input input-mini" type=text name=memory_limit size=20 value='<?php echo htmlentities($row['memory_limit'],ENT_QUOTES,"UTF-8")?>'> MB<br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Description."</h4>"?>
          <textarea class="kindeditor" rows=13 name=description cols=80><?php echo htmlentities($row['description'],ENT_QUOTES,"UTF-8")?></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Input."</h4>"?>
          <textarea class="kindeditor" rows=13 name=input cols=80><?php echo htmlentities($row['input'],ENT_QUOTES,"UTF-8")?></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Output."</h4>"?>
          <textarea  class="kindeditor" rows=13 name=output cols=80><?php echo htmlentities($row['output'],ENT_QUOTES,"UTF-8")?></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Sample_Input."</h4>"?>
          <textarea  class="input input-large" style="width:100%;" rows=13 name=sample_input><?php echo htmlentities($row['sample_input'],ENT_QUOTES,"UTF-8")?></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Sample_Output."</h4>"?>
          <textarea  class="input input-large" style="width:100%;" rows=13 name=sample_output><?php echo htmlentities($row['sample_output'],ENT_QUOTES,"UTF-8")?></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_HINT."</h4>"?>
          <textarea class="kindeditor" rows=13 name=hint cols=80><?php echo htmlentities($row['hint'],ENT_QUOTES,"UTF-8")?></textarea><br>
        </p>
        <p>
          <?php echo "<h4>".$MSG_SPJ."</h4>"?>
          <?php echo "(".$MSG_HELP_SPJ.")"?><br>
          <?php echo "No "?><input type=radio name=spj value='0' <?php echo $row['spj']=="0"?"checked":""?>>
          <?php echo "/ Yes "?><input type=radio name=spj value='1' <?php echo $row['spj']=="1"?"checked":""?>><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_SOURCE."</h4>"?>
          <textarea name=source style="width:100%;" rows=1><?php echo htmlentities($row['source'],ENT_QUOTES,"UTF-8")?></textarea><br><br>
        </p>
        <p align=left>
          <?php $MSG_TYPE = "类型选择";  echo "<h4>".$MSG_TYPE."</h4>"?>  
          <input id= "chooseType" type="text" name="type"  value = <?php echo htmlentities($row['type'],ENT_QUOTES,"UTF-8")?> />    
          <?php 
          echo "
            
            <span class=\"tag label label-info\"    >线性结构</span>
            <span class=\"tag label label-primary\" >树形结构</span>
            <span class=\"tag label label-success\" >堆</span>
            <span class=\"tag label label-info\"    >图</span>
            <span class=\"tag label label-warning\" >排序算法</span>
            <span class=\"tag label label-danger\"  >动态规划</span>

            <span class=\"tag label label-info\"    >贪心算法</span>
            <span class=\"tag label label-primary\" >搜索</span>
            <span class=\"tag label label-success\" >字符串</span>
            <span class=\"tag label label-info\"    >基础练习</span>
            <span class=\"tag label label-warning\" >数论</span>
            <span class=\"tag label label-danger\"  >其他</span>
          "
          ?>
        </p>  
        <p align=left>
          <?php $MSG_TYPE = "难度选择";  echo "<h4>".$MSG_TYPE."</h4>"?>  
          <select name = 'difficulty'>
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>
          </select>
        </p>
        <div align=center>
          <?php require_once("../include/set_post_key.php");?>
          <input type="submit" value="Submit" name="submit">
        </div>
      </input>
    </form>

    <?php
    }else{
      require_once("../include/check_post_key.php");
      $id=intval($_POST['problem_id']);
      if(!(isset($_SESSION[$OJ_NAME.'_'."p$id"])||isset($_SESSION[$OJ_NAME.'_'.'administrator']))) exit();  

      $title=$_POST['title'];
      $title = str_replace(",", "&#44;", $title);
      $time_limit=$_POST['time_limit'];
      $memory_limit=$_POST['memory_limit'];
      $description=$_POST['description'];
      $description = str_replace("<p>", "", $description); 
      $description = str_replace("</p>", "<br />", $description);
      $description = str_replace(",", "&#44;", $description);
      
      $input=$_POST['input'];
      $input = str_replace("<p>", "", $input); 
      $input = str_replace("</p>", "<br />", $input);
      $input = str_replace(",", "&#44;", $input);
      
      $output=$_POST['output'];
      $output = str_replace("<p>", "", $output); 
      $output = str_replace("</p>", "<br />", $output); 
      $output = str_replace(",", "&#44;", $output);

      $sample_input=$_POST['sample_input'];
      $sample_output=$_POST['sample_output'];
      $hint=$_POST['hint'];
      $hint = str_replace("<p>", "", $hint); 
      $hint = str_replace("</p>", "<br />", $hint);
      $hint = str_replace(",", "&#44;", $hint);

      $source=$_POST['source'];
      $spj=$_POST['spj'];

      $type = $_POST['type'];
      $difficulty = $_POST['difficulty'];

      if(get_magic_quotes_gpc()){
        $title = stripslashes($title);
        $time_limit = stripslashes($time_limit);
        $memory_limit = stripslashes($memory_limit);
        $description = stripslashes($description);
        $input = stripslashes($input);
        $output = stripslashes($output);
        $sample_input = stripslashes($sample_input);
        $sample_output = stripslashes($sample_output);
        //$test_input = stripslashes($test_input);
        //$test_output = stripslashes($test_output);
        $hint = stripslashes($hint);
        $source = stripslashes($source); 
        $spj = stripslashes($spj);
        $source = stripslashes($source);
        $type = stripslashes($type);
        $difficulty = intval($difficulty);
      }

      $title=($title);
      $description=RemoveXSS($description);
      $input=RemoveXSS($input);
      $output=RemoveXSS($output);
      $hint=RemoveXSS($hint);
      $basedir=$OJ_DATA."/$id";


      
      echo "Sample data file Updated!<br>";
      echo "".is_string($type);
      if($sample_input&&file_exists($basedir."/sample.in")){
        //mkdir($basedir);
        $fp=fopen($basedir."/sample.in","w");
        fputs($fp,preg_replace("(\r\n)","\n",$sample_input));
        fclose($fp);

        $fp=fopen($basedir."/sample.out","w");
        fputs($fp,preg_replace("(\r\n)","\n",$sample_output));
        fclose($fp);
      }

      $spj=intval($spj);
  
      $sql="UPDATE `problem` set `title`=?,`time_limit`=?,`memory_limit`=?,
                   `description`=?,`input`=?,`output`=?,`sample_input`=?,`sample_output`=?,`hint`=?,`source`=?,`spj`=?,`type`=?,`difficulty`=?,`in_date`=NOW()
            WHERE `problem_id`=?";

      @pdo_query($sql,$title,$time_limit,$memory_limit,$description,$input,$output,$sample_input,$sample_output,$hint,$source,$spj,$type,$difficulty,$id) ;
      echo "Edit OK!";
      echo "<a href='../problem.php?id=$id'>See The Problem!</a>";
    }
    ?>
  </div>
  <script>

  </script>
  <?php 
  echo 
   "<script>
    var type = document.getElementById('chooseType');
    var tags = document.getElementsByClassName('tag');
    for (var i = 0; i < tags.length; i++) {
      tags[i].addEventListener('click', setChange, false);
    }

    function setChange(e) {
      
      if(type.value === e.target.innerText)
      {
        type.value = \" \";
      }
      else
      {
        type.value =  e.target.innerText; 
      }
    }
  
  </script>" ?>
  </body>
  </html>
   
