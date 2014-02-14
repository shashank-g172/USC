package com.example.assignment9;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.MalformedURLException;

import org.json.JSONArray;
import org.json.JSONObject;

import android.R;
import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.widget.Button;
import android.widget.Toast;

import com.facebook.android.AsyncFacebookRunner;
import com.facebook.android.AsyncFacebookRunner.RequestListener;
import com.facebook.android.DialogError;
import com.facebook.android.Facebook;
import com.facebook.android.Facebook.DialogListener;
import com.facebook.android.FacebookError;

public class ParseFacebook extends Activity{
	private static String APP_ID = "356651771112469"; // Replace with your App ID
	private Facebook facebook = new Facebook(APP_ID);
	private AsyncFacebookRunner mAsyncRunner;
	String FILENAME = "AndroidSSO_data";
	private SharedPreferences myPreferences;

	Button btnFbLogin;
	Button btnFbGetProfile;
	Button btnPostToWall;
	Button btnShowAccessTokens;
	
	String type;
	String cover;
	String name;
	String title;
	String year;
	String genre;
	String artist;
	String composers;
	String performers;
	String sample;
	String details;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		Intent myIntent=getIntent();
		type=myIntent.getStringExtra("com.example.assignment9.type");
		if(type.equals("Artists"))
		{
			//(cover[i],name[i],genre[i],year[i],details[i])
			cover=myIntent.getStringExtra("com.example.assignment9.cover");
			name=myIntent.getStringExtra("com.example.assignment9.name");
			genre=myIntent.getStringExtra("com.example.assignment9.genre");
			year=myIntent.getStringExtra("com.example.assignment9.year");
			details=myIntent.getStringExtra("com.example.assignment9.details");
		}
		else if(type.equals("Albums"))
		{
			cover=myIntent.getStringExtra("com.example.assignment9.cover");
			title=myIntent.getStringExtra("com.example.assignment9.title");
			artist=myIntent.getStringExtra("com.example.assignment9.artist");		
			genre=myIntent.getStringExtra("com.example.assignment9.genre");
			year=myIntent.getStringExtra("com.example.assignment9.year");
			details=myIntent.getStringExtra("com.example.assignment9.details");		
		}
		else
		{
			cover=myIntent.getStringExtra("com.example.assignment9.cover");
			sample=myIntent.getStringExtra("com.example.assignment9.sample");			
			title=myIntent.getStringExtra("com.example.assignment9.title");
			performers=myIntent.getStringExtra("com.example.assignment9.performers");
			composers=myIntent.getStringExtra("com.example.assignment9.composers");
			details=myIntent.getStringExtra("com.example.assignment9.details");		
		}
			
		super.onCreate(savedInstanceState);
		setContentView(R.layout.fb_init);	
		mAsyncRunner = new AsyncFacebookRunner(facebook);
		loginToFacebook();
	}
	
	public void loginToFacebook() {
		myPreferences = getPreferences(MODE_PRIVATE);
		String access_token = myPreferences.getString("access_token", null);
		long expires = myPreferences.getLong("access_expires", 0);
		if (access_token != null) {						
			facebook.setAccessToken(access_token);
			Log.d("FB Sessions", "" + facebook.isSessionValid());
		}

		if (expires != 0) {
			facebook.setAccessExpires(expires);
		}

		if (!facebook.isSessionValid()) {
			facebook.authorize(this,
					new String[] { "email", "publish_stream" },
					new DialogListener() {
						@Override
						public void onCancel() {	
							finish();
						}

						@Override
						public void onComplete(Bundle values) {
							// Function to handle complete event
							// Edit Preferences and update facebook acess_token
							//SharedPreferences.Editor editor = mPrefs.edit();
							//editor.putString("access_token",
								//	facebook.getAccessToken());
							//editor.putLong("access_expires",
								//	facebook.getAccessExpires());
							//editor.commit();
							postToWall();
						}

						@Override
						public void onError(DialogError error) {							
							finish();
							// Function to handle error
						}
						
						@Override
						public void onFacebookError(FacebookError fberror) {							
							finish();
							// Function to handle Facebook errors
						}
					});
		}
	}
	
	public void postToWall() {
		Bundle params = new Bundle();
		
		JSONObject attachment = new JSONObject();
	    JSONObject properties = new JSONObject();
	    JSONObject prop = new JSONObject();
	    JSONObject media = new JSONObject();
       
	    try
	       {
	    		if(type.equals("Artists"))
	    		{
	    			attachment.put("name",name);
	    			attachment.put("href", details);
	    			attachment.put("caption","I like "+name+" who is active since "+year);
	    			attachment.put("description","Genre of Music is : "+genre);
	    			media.put("type", "image");
	        		media.put("src", cover);
	        		media.put("href", details);
	        		attachment.put("media",new JSONArray().put(media));
	        		prop.put("text", "here");
	        		prop.put("href", details);
	        		properties.put("Look at details ", prop);	     
	    		}
	    		else if(type.equals("Albums"))
	    		{
	    			attachment.put("name",title);
	    			attachment.put("href", details);
	    			attachment.put("caption","I like "+title+" released in "+year);
	    			attachment.put("description","Artist : "+title+" & Genre : "+genre);
	    			media.put("type", "image");
	        		media.put("src", cover);
	        		media.put("href", details);
	        		attachment.put("media",new JSONArray().put(media));
	        		prop.put("text", "here");
	        		prop.put("href", details);
	        		properties.put("Look at details ", prop);	    			
	    		}
	    		else
	    		{
	    			attachment.put("name",title);
	    			attachment.put("href",details);	    				
	    			attachment.put("caption","I like "+title+" composed by "+composers);
	    			attachment.put("description","Performer : "+performers);
	    			media.put("type", "image");
	    			media.put("src", cover);
	    			Log.d(":----------->:", "Cover Href - "+cover);
	        		if(!sample.equals("NA") && sample!=null && !sample.equals("N/A"))
	        		{
	        			Log.d(":----------->:", "Sample Href - "+sample);
	        			media.put("href",sample);
	        		}
	        		else
	        		{
	        			Log.d(":----------->:", "Cover Href");
		        		media.put("href",cover);
	        		}
	        		attachment.put("media",new JSONArray().put(media));
	        		prop.put("text", "here");
	        		prop.put("href", details);
	        		properties.put("Look at details ", prop);
	    		}
	    			
	    		attachment.put("properties", properties);	    		
	    		params.putString("attachment", attachment.toString());
	       }
	    catch (Exception e){}
	      
		    facebook.dialog(this, "stream.publish", params,new DialogListener() {
				

				@Override
				public void onFacebookError(FacebookError e) {
					Toast toast = Toast.makeText(getApplicationContext(),
							"FACEBOOK ERROR",
							Toast.LENGTH_SHORT);
							toast.setGravity(Gravity.BOTTOM|Gravity.CENTER_HORIZONTAL, 0, 0);
							toast.show();
					finish();
				}

				@Override
				public void onError(DialogError e) {
					Toast toast = Toast.makeText(getApplicationContext(),
							"Error occured while Posting. Please try again",
							Toast.LENGTH_SHORT);
							toast.setGravity(Gravity.BOTTOM|Gravity.CENTER_HORIZONTAL, 0, 0);
							toast.show();
					finish();
					
				}

				@Override
				public void onComplete(Bundle values) {
					 if (values.isEmpty())
			            {
						 	Toast toast = Toast.makeText(getApplicationContext(),
									"Not Posted on Facebook",
									Toast.LENGTH_SHORT);
									toast.setGravity(Gravity.BOTTOM|Gravity.CENTER_HORIZONTAL, 0, 0);
									toast.show();	
							finish();

			            }
					 else
					 {
						 	Toast toast = Toast.makeText(getApplicationContext(),
									"Posted On Facebook Wall",
									Toast.LENGTH_SHORT);
									toast.setGravity(Gravity.BOTTOM|Gravity.CENTER_HORIZONTAL, 0, 0);
									toast.show();
							finish();
					 }
						
				}

				@Override
				public void onCancel() {
					Toast toast = Toast.makeText(getApplicationContext(),
							"Not Posted On Facebook",
							Toast.LENGTH_SHORT);
							toast.setGravity(Gravity.BOTTOM|Gravity.CENTER_HORIZONTAL, 0, 0);
							toast.show();
					finish();
				}
			});

		}
		@Override
		public void onActivityResult(int requestCode, int resultCode, Intent data) {
			super.onActivityResult(requestCode, resultCode, data);
			facebook.authorizeCallback(requestCode, resultCode, data);
		}



		public void logoutFromFacebook() {
			mAsyncRunner.logout(this, new RequestListener() {
				@Override
				public void onComplete(String response, Object state) {
					if (Boolean.parseBoolean(response) == true) {
						runOnUiThread(new Runnable() {
							@Override
							public void run() {
							}

						});

					}
				}

				@Override
				public void onIOException(IOException e, Object state) {
				}

				@Override
				public void onFileNotFoundException(FileNotFoundException e,
						Object state) {
				}

				@Override
				public void onMalformedURLException(MalformedURLException e,
						Object state) {
				}

				@Override
				public void onFacebookError(FacebookError e, Object state) {
				}
			});
		}
}

