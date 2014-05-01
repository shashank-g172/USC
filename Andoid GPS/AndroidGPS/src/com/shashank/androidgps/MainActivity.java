package com.shashank.androidgps;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Date;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeader;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.protocol.HTTP;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Looper;
import android.provider.Settings.Secure;
import android.util.Log;
import android.view.Menu;
import android.widget.TextView;

public class MainActivity extends Activity implements LocationListener {

	private TextView textView1;

	private String username = null;
	private String phoneid = null;
	LocationManager locationManager;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		Intent intent = getIntent();
		phoneid = Secure.getString(getApplicationContext().getContentResolver(), Secure.ANDROID_ID);

		if (intent.getExtras().get("username") != null)
			username = (String)intent.getExtras().get("username");

		locationManager =   (LocationManager) this.getSystemService(Context.LOCATION_SERVICE);
		locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, this);
		Log.e("GPSTRACKER", "OnCreate");

		textView1 = (TextView) findViewById(R.id.textView1);
		setContentView(R.layout.activity_main);
	}


	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	private JSONArray userData = new JSONArray();
	@Override
	public void onLocationChanged(Location arg0) {
		// TODO Auto-generated method stub
		if (textView1 != null)
		{
			//Log.e("GPSTRACKER", "onLocationChanged null");
			textView1.setText(arg0.getLatitude() + "," + arg0.getLongitude());
		} else
		{
			textView1 = (TextView)findViewById(R.id.textView1);
		}

		JSONObject json = new JSONObject(); 
		try {
			json.put("Longitude", arg0.getLongitude());
			json.put("Latitude", arg0.getLatitude());
			json.put("UserName", username);
			json.put("PhoneID", phoneid);
			json.put("time", new Date().getTime());
			userData.put(json);
			if (userData.length() >= 20)
			{
				//JSONArray temp = userData;
				sendJson(userData);
				userData = new JSONArray();

			}
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			Log.e("GPSTRACKER", e.toString());
		}
		//Log.e("GPSTRACKER", "onLocationChanged");
	}

	@Override 
	public void onDestroy(){
		super.onDestroy();
		locationManager.removeUpdates(this);
		Log.d("GPSTRACKER", "unregistering GPS data");
	}
	
	protected void sendJson(final JSONArray userData) {
		Thread t = new Thread() {

			public void run() {
				InputStream in = null;
				Looper.prepare(); //For Preparing Message Pool for the child Thread
				HttpClient client = new DefaultHttpClient();
				HttpConnectionParams.setConnectionTimeout(client.getParams(), 10000); //Timeout Limit
				HttpResponse response;

				try {
					HttpPost post = new HttpPost("http://secret-river-4905.herokuapp.com/AndroidTest.php");
					StringEntity se = new StringEntity( userData.toString());  
					se.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));
					post.setEntity(se);
					response = client.execute(post);

					/*Checking response */
					if(response!=null){
						in = response.getEntity().getContent(); //Get the data in the entity
					}
					Log.i("GPSTRACKER","Data Sent successfully");
				} catch(Exception e) {
					e.printStackTrace();
					Log.e("GPSTRACKER", "server error &&&&&&&&&&&&&&&");
					//createDialog("Error", "Cannot Estabilish Connection");
				}
				String result = "";
				try {
					BufferedReader bReader = new BufferedReader(new InputStreamReader(in, "iso-8859-1"), 8);
					StringBuilder sBuilder = new StringBuilder();

					String line = null;
					while ((line = bReader.readLine()) != null) {
						sBuilder.append(line + "\n");
					}

					in.close();
					result = sBuilder.toString();
					Log.e("GPSTRACKER", result);
				} catch (Exception e) {
					Log.e("StringBuilding & BufferedReader", "Error converting result " + e.toString());
				}
				Looper.loop(); //Loop in the message queue

			}
		};

		t.start();      
	}

	@Override
	public void onProviderDisabled(String arg0) {
		// TODO Auto-generated method stub

	}


	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub

	}


	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub

	}

}
