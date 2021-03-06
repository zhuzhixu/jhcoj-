<html>
<head>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Content-Language" content="zh-cn">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Problem Add</title>
  <link rel="stylesheet" href="../font/style.css" />
  <style>
    #changeDifficulty>span{
      margin-left:-4px
    }
  </style>
</head>
<hr>

<?php 
  require_once("../include/db_info.inc.php");
  require_once("admin-header.php");
  if(!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
  }
  echo "<center><h3>$MSG_ADD"."$MSG_PROBLEM</h3></center>";
  include_once("kindeditor.php");
  $MSG_TYPE = "类型选择";
  $MSG_DIFFICULTY = "难度选择";
?>

<body leftmargin="30" >
  <div class="container">
    <form method=POST action=problem_add.php>
      <input type=hidden name=problem_id value="New Problem">
        <p align=left>
          <?php echo "<h3>".$MSG_TITLE."</h3>"?>
          <input class="input input-xxlarge" style="width:100%;" type=text name=title><br><br>
        </p>
        <p align=left>
          <?php echo $MSG_Time_Limit?><br>
          <input class="input input-mini" type=text name=time_limit size=20 value=1> Sec<br><br>
          <?php echo $MSG_Memory_Limit?><br>
          <input class="input input-mini" type=text name=memory_limit size=20 value=128> MB<br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Description."</h4>"?>
          <textarea class="kindeditor" rows=13 name=description cols=80></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Input."</h4>"?>
          <textarea class="kindeditor" rows=13 name=input cols=80></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Output."</h4>"?>
          <textarea  class="kindeditor" rows=13 name=output cols=80></textarea><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Sample_Input."</h4>"?>
          <textarea  class="input input-large" style="width:100%;" rows=13 name=sample_input></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Sample_Output."</h4>"?>
          <textarea  class="input input-large" style="width:100%;" rows=13 name=sample_output></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Test_Input."</h4>"?>
          <?php echo "(".$MSG_HELP_MORE_TESTDATA_LATER.")"?><br>
          <textarea class="input input-large" style="width:100%;" rows=13 name=test_input></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_Test_Output."</h4>"?>
          <?php echo "(".$MSG_HELP_MORE_TESTDATA_LATER.")"?><br>
          <textarea class="input input-large" style="width:100%;" rows=13 name=test_output></textarea><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_HINT."</h4>"?>
          <textarea class="kindeditor" rows=13 name=hint cols=80></textarea><br>
        </p>
        <p>
          <?php echo "<h4>".$MSG_SPJ."</h4>"?>
          <?php echo "(".$MSG_HELP_SPJ.")"?><br>
          <?php echo "No "?><input type=radio name=spj value='0' checked><?php echo "/ Yes "?><input type=radio name=spj value='1'><br><br>
        </p>
        <p align=left>
          <?php echo "<h4>".$MSG_SOURCE."</h4>"?>
          <textarea name=source style="width:100%;" rows=1></textarea><br><br>
        </p>
        <p align=left><?php echo "<h4>".$MSG_CONTEST."</h4>"?>
          <select name=contest_id>
            <?php
            $sql="SELECT `contest_id`,`title` FROM `contest` WHERE `start_time`>NOW() order by `contest_id`";
            $result=pdo_query($sql);
            echo "<option value=''>none</option>";
            if (count($result)==0){
            }else{
              foreach($result as $row){
                echo "<option value='{$row['contest_id']}'>{$row['contest_id']} {$row['title']}</option>";
              }
            }?>
          </select>
        </p>
        <p align=left>
          <?php $MSG_TYPE = "类型选择";  echo "<h4>".$MSG_TYPE."</h4>"?>  
          <input id= "chooseType" type="text" name="type" />    
          <?php 
          $difficulty = intval($row['difficulty']); 
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
          <?php echo 
              "<select name = 'difficulty' id='select'>
              <option value = 0 >0</option>
              <option value = 1>1</option>
              <option value = 2>2</option>
              <option value = 3>3</option>
              <option value = 4>4</option>
              <option value = 5>5</option>
              <option value = 6>6</option>
              <option value = 7>7</option>
              <option value = 8>8</option>
              <option value = 9>9</option>
              <option value = 10>10</option>
            </select>"
          ?> 
        </p>
        <div align=center>
          <?php require_once("../include/set_post_key.php");?>
          <input type=submit value=Submit name=submit>
        </div>
      </input>
    </form>
  </div>
  <?php 
echo 
"<script>
var type = document.getElementById('chooseType');
var tags = document.getElementsByClassName('tag');

function setType(e){
  if(type.value.indexOf(e.target.innerText) > -1){
    type.value = type.value.replace(e.target.innerText + \" \", \"\");
  } else {
    type.value += e.target.innerText + \" \";
  }
}

for(var i = 0; i < tags.length; i++){
  tags[i].addEventListener('click', setType, false);
}

var num = $difficulty;
var select = document.getElementById(\"select\").getElementsByTagName(\"option\");
select[num].selected = true;
</script>";
?>
</body>
</html>
