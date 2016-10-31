package com.ideabobo.tool;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.nio.channels.FileChannel;

import android.content.Context;
import android.os.AsyncTask;
import android.os.Environment;
import android.util.Log;

public class FileTool extends AsyncTask<String, Void, Integer>{
	private static final String COMMAND_BACKUP = "backupDatabase";
    public static final String COMMAND_RESTORE = "restoreDatabase";
    private Context mContext;

    public FileTool(Context context) {
        this.mContext = context;
    }

    @Override
    public Integer doInBackground(String... params) {


        File dbFileDir = mContext.getDatabasePath("/data/data/com.ideabobo.gap/");
        File exportDir = new File(Environment.getExternalStorageDirectory(),
                "ideaback/");
        if (!exportDir.exists()) {
            exportDir.mkdirs();
        }
        String command = params[0];
        if (command.equals(COMMAND_BACKUP)) {
            try {
                copyDirectiory(dbFileDir.getAbsolutePath(), exportDir.getAbsolutePath());
                return Log.d("backup", "ok");
            } catch (Exception e) {
                e.printStackTrace();
                return Log.d("backup", "fail");
            }
        } else if (command.equals(COMMAND_RESTORE)) {
            try {
            	copyDirectiory(exportDir.getAbsolutePath(), dbFileDir.getAbsolutePath());
                return Log.d("restore", "success");
            } catch (Exception e) {
                // TODO: handle exception
                e.printStackTrace();
                return Log.d("restore", "fail");
            }
        } else {
            return null;
        }
    }

    private void fileCopy(File dbFile, File backup) throws IOException {
        // TODO Auto-generated method stub
        FileChannel inChannel = new FileInputStream(dbFile).getChannel();
        FileChannel outChannel = new FileOutputStream(backup).getChannel();
        try {
            inChannel.transferTo(0, inChannel.size(), outChannel);
        } catch (IOException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {
            if (inChannel != null) {
                inChannel.close();
            }
            if (outChannel != null) {
                outChannel.close();
            }
        }
    }
    

    public static void copyDirectiory(String sourceDir, String targetDir) throws IOException {

        (new File(targetDir)).mkdirs();

        File[] file = (new File(sourceDir)).listFiles();
        for (int i = 0; i < file.length; i++) {
            if (file[i].isFile()) {

                File sourceFile = file[i];

                File targetFile = new File(new File(targetDir).getAbsolutePath() + File.separator + file[i].getName());
                copyFile(sourceFile, targetFile);
            }
            else if (file[i].isDirectory()) {
                String dir1 = sourceDir + "/" + file[i].getName();
                String dir2 = targetDir + "/" + file[i].getName();
                copyDirectiory(dir1, dir2);
            }
        }
    }


    public static void copyFile(File sourceFile, File targetFile) throws IOException {
        BufferedInputStream inBuff = null;
        BufferedOutputStream outBuff = null;
        try {
            inBuff = new BufferedInputStream(new FileInputStream(sourceFile));

            outBuff = new BufferedOutputStream(new FileOutputStream(targetFile));

            byte[] b = new byte[1024 * 5];
            int len;
            while ((len = inBuff.read(b)) != -1) {
                outBuff.write(b, 0, len);
            }
            outBuff.flush();
        } finally {

            if (inBuff != null)
                inBuff.close();
            if (outBuff != null)
                outBuff.close();
        }
    }
    
    public static void delFolder(String folderPath) {
        try {
           delAllFile(folderPath);
           String filePath = folderPath;
           filePath = filePath.toString();
           java.io.File myFilePath = new java.io.File(filePath);
           myFilePath.delete();
        } catch (Exception e) {
          e.printStackTrace(); 
        }
   }
   

      public static boolean delAllFile(String path) {
          boolean flag = false;
          File file = new File(path);
          if (!file.exists()) {
            return flag;
          }
          if (!file.isDirectory()) {
            return flag;
          }
          String[] tempList = file.list();
          File temp = null;
          for (int i = 0; i < tempList.length; i++) {
             if (path.endsWith(File.separator)) {
                temp = new File(path + tempList[i]);
             } else {
                 temp = new File(path + File.separator + tempList[i]);
             }
             if (temp.isFile()) {
                temp.delete();
             }
             else if (temp.isDirectory()) {
                delAllFile(path + "/" + tempList[i]);
                delFolder(path + "/" + tempList[i]);
                flag = true;
             }
          }
          return flag;
        }
      
      public static String getSDPath(){ 
          File sdDir = null; 
          boolean sdCardExist = Environment.getExternalStorageState()   
                              .equals(android.os.Environment.MEDIA_MOUNTED);
          if(sdCardExist){                               
            sdDir = Environment.getExternalStorageDirectory();
          }   
          return sdDir.toString();   
      }
}
