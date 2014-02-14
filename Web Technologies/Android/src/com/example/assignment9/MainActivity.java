package com.example.assignment9;



import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

import android.R;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;

public class MainActivity extends Activity {
	
	Button mButton;
	EditText mEdit;
	Spinner spinner; 
	String type;
	final Context context=this;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		mButton = (Button)findViewById(R.id.btnSearch);
		mButton.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {				
				// TODO Auto-generated method stub
				mEdit   = (EditText)findViewById(R.id.editText);
        		String title= mEdit.getText().toString();
        		if(title.replaceAll(" ", "").equals(""))
        		{
        			AlertDialog.Builder builder = new AlertDialog.Builder(context);
        			builder.setMessage("Enter a title")
        			       .setPositiveButton("OK", new DialogInterface.OnClickListener() {
        			           public void onClick(DialogInterface dialog, int id) {
        			               dialog.dismiss();
        			           }
        			        });
        			AlertDialog alert = builder.create();
        			alert.show();
        			return;
        		}
        		
        		ConnectivityManager connectivityManager = (ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo info = connectivityManager.getActiveNetworkInfo();
                if(info == null)
                {
                	AlertDialog.Builder builder = new AlertDialog.Builder(context);
        			builder.setMessage("No Internet Connection")
        			       .setPositiveButton("OK", new DialogInterface.OnClickListener() {
        			           public void onClick(DialogInterface dialog, int id) {
        			               dialog.dismiss();
        			           }
        			       });
        			AlertDialog alert = builder.create();
        			alert.show();
        			return;
                }
                try {
					title = URLEncoder.encode(title, "UTF-8");
				} 
                catch (UnsupportedEncodingException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
                String mtype="";
                spinner = (Spinner)findViewById(R.id.spinner);
        		type= spinner.getSelectedItem().toString();
        		if(type.equals("Albums"))
            		mtype="Albums";
        		else if(type.equals("Artists"))
                	mtype="Artists";
        		else	
        			mtype="Songs";
            		
        		String url="http://cs-server.usc.edu:14187/examples/servlet/Assignment8?title="+title+"&type="+mtype;
        //		TextView mText = (TextView)findViewById(R.id.textViewOutput);
          //  	mText.setText(url);
             
        		Retrieve(url);
			}
		});
		}

	/*@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_main, menu);
		return true;
	}*/
	
	public void Retrieve (String url) {
        GetXMLTask task = new GetXMLTask();
        task.execute(new String[] { url });
    }

	private class GetXMLTask extends AsyncTask<String, Void, String> {
       @Override
        protected String doInBackground(String... urls) {
        	String output = null;
        	for (String url : urls) {
        		System.out.println(url);
                output = getOutputFromUrl(url);
                Log.d("Inside Aysnc", "---------------------------------");
            }
      
        	return output;
         }
 
        private String getOutputFromUrl(String url) {
            StringBuffer output = new StringBuffer("");
            try {
                InputStream stream = getHttpConnection(url);
                BufferedReader buffer = new BufferedReader(
                        new InputStreamReader(stream,"UTF-8"));
                String s = "";
                while ((s = buffer.readLine()) != null)
                    output.append(s);
            } catch (IOException e1) {
                e1.printStackTrace();
            }
            return output.toString();
        }
 
        private InputStream getHttpConnection(String urlString)
                throws IOException {
            InputStream stream = null;
            URL url = new URL(urlString);
            URLConnection connection = url.openConnection();
 
            try {
                HttpURLConnection httpConnection = (HttpURLConnection) connection;
                httpConnection.setRequestMethod("GET");
                httpConnection.connect();
 
                if (httpConnection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                    stream = httpConnection.getInputStream();
                }
            } catch (Exception ex) {
                ex.printStackTrace();
            }
            return stream;
        }
 
        @Override
        protected void onPostExecute(String output) {
 			Intent myIntent = new Intent(context,Parse.class);
        	myIntent.setAction(Intent.ACTION_SEND);
        	myIntent.putExtra("com.example.assignment9.output",output);
        	myIntent.putExtra("com.example.assignment9.type",type);
        	myIntent.setType("text/plain");
        	startActivity(myIntent);  
        	//TextView mText = (TextView)findViewById(R.id.textViewOutput);
        	//mText.setText(output);
         }
      
	}


}
