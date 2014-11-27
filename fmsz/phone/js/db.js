var dbname ='fumeishengzi.db';
 var cText = 0;
 var cJson = 1;
 var cInt = 2;
function createDB(){
	
	 uexDataBaseMgr.openDataBase(dbname,1);
	uexDataBaseMgr.cbOpenDataBase = createDBCallBack;
}

function closeDB(){
	
	  uexDataBaseMgr.closeDataBase(dbname,1);
}

function createDBCallBack(opid,type,data){
                            switch(type){
                                case cText:
                                    //("uex.cText");
                                    break;
                                case cJson:
                                 // alert("uex.cJson");
                                    break;
                                case cInt:
                                if(opid == 1 &&type == 2&&data == 0){
                                  $toast("数据库打开成功！",1000);
                                }else{
                                    $toast("数据库打开失败！",1000);
                                }
                                break;
                              default:
                                  $toast("error",1000);
                          }
            }
 function createTable(sql){
                    
                            uexDataBaseMgr.executeSql(dbname,1,sql);
                            //Sql语句的执行的回调
                            uexDataBaseMgr.cbExecuteSql = createTableCallBack;
                        }
   function insertData(sql){
   
                            //Sql语句的执行
                            uexDataBaseMgr.executeSql(dbname,1,sql);
                            //Sql语句的执行的回调
                          //  uexDataBaseMgr.cbExecuteSql = insertDataCallBack;
                        }
  function selectData(sql){
                            //Sql语句的查询
                            uexDataBaseMgr.selectSql(dbname,1,sql);
                            //Sql语句的查询的回调
                            uexDataBaseMgr.cbSelectSql = selectDataCallBack;
                        }
 function updateData(sql){
                            //Sql语句的执行
                            uexDataBaseMgr.executeSql(dbname,1,sql);
                            uexDataBaseMgr.cbSelectSql = updateDataCallBack;
                        }						
   function createTableCallBack(opid,type,data){
                            switch(type){
                                case cText:
                                   $toast("uex.cText");
                                    break;
                                case cJson:
                                  $toast("uex.cJson");
                                    break;
                                case cInt:
                                if(opid == 1&&type == 2 &&data == 0){
                                  //  $toast("表创建成功！");
                                }else{
                                     $toast("表创建失败！");
                                }
                                break;
                              default:
                                  $toast("error");     
                          }
             }
  function insertDataCallBack(opid,type,data){
                            switch(type){
                                case cText:
                                    alert("uex.cText");
                                    break;
                                case cJson:
                                  alert("uex.cJson");
                                    break;
                                case cInt:
                                if(opid == 1&&type == 2 &&data == 0){
                                    alert("数据插入成功！");
                                }else{
                                     alert("数据插入失败！");
                                }
                                break;
                              default:
                                  alert("error");  
                          }
                 }
