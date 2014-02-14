package com.example.assignment9;

import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.R;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;

public class Parse extends Activity implements OnItemClickListener{
	ListView listView;
    //List<RowItem> rowItems;
	String []cover=new String[5];
	String []name=new String[5];
	String []genre=new String[5];
	String []year=new String[5];
	String []details=new String[5];
	String []title=new String[5];
	String []artist=new String[5];
	String []performers=new String[5];
	String []composers=new String[5];
	String []sample=new String[5];
	MyCustomAdapter adapter;
	String type="";
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
    	Intent intent = getIntent();
	    String output = intent.getStringExtra("com.example.assignment9.output");
	    type=intent.getStringExtra("com.example.assignment9.type");
	    
	    super.onCreate(savedInstanceState);
        setContentView(R.layout.output);
        //Log.d("---------->*********", output);
	    JSONObject jsonObj;
	    Object root = null; 
	    try {
	    		jsonObj = new JSONObject(output);
	    		root = jsonObj.get("results");
		
	    		if(root instanceof JSONArray)
	    		{					    			
	    			AlertDialog.Builder builder = new AlertDialog.Builder(this);
        			builder.setMessage("No Discography Results")
        			       .setPositiveButton("OK", new DialogInterface.OnClickListener() {
        			           public void onClick(DialogInterface dialog, int id) {
        			               dialog.dismiss();
        			               Intent myIntent=new Intent(Parse.this,MainActivity.class);
        			               startActivity(myIntent);
        			           }
        			       });
        			AlertDialog alert = builder.create();
        			alert.show();
        			return;
	    		}
	    		else
	    		{	    			
	    			JSONArray rootChildren=((JSONObject)root).getJSONArray("result");
					int lenRootChildren=rootChildren.length();
					if(type.equals("Artists"))
						parseJsonArtists(rootChildren,lenRootChildren);
					else if(type.equals("Albums"))
						parseJsonAlbums(rootChildren,lenRootChildren);
					else
						parseJsonSongs(rootChildren,lenRootChildren);	
			    }	
			}
			catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			}
	    
	    ArrayList rowItems;
	    if(type.equals("Artists"))
	    {
	    	rowItems=new ArrayList<Artist>();
	    	int i=0;
	    	while(i<5 && cover[i]!=null)
	    	{
	    		rowItems.add(new Artist(cover[i],name[i],genre[i],year[i],details[i]));
	    		i++;
	    		
	    	}	
	    }
	    else if(type.equals("Albums"))
	    {
	    	rowItems=new ArrayList<Album>();
	    	int i=0;
	    	while(i<5 && cover[i]!=null)
	    	{
	    		rowItems.add(new Album(cover[i],title[i],artist[i],genre[i],year[i],details[i]));
	    		i++;
	    	}
	    }
	    else
	    {
	    	rowItems=new ArrayList<Song>();
	    	int i=0;
	    	while(i<5 && cover[i]!=null)
	    	{
	    		rowItems.add(new Song(cover[i],title[i],sample[i],performers[i],composers[i],details[i]));
	    		i++;
	    	}
	    }
	    
	    listView = (ListView) findViewById(R.id.listView);
	    adapter = new MyCustomAdapter(this, rowItems);	          
	    listView.setAdapter(adapter);  
	    listView.setOnItemClickListener(this);
   }	
    
    @Override
    public void onItemClick(AdapterView<?> parent, View view, final int position,long id)
	{
    	final Activity context=this;
    	AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(context);    	
    	LayoutInflater mLayoutInflater = (LayoutInflater)
                context.getSystemService(Activity.LAYOUT_INFLATER_SERVICE);
    	View v=null;
    	v= mLayoutInflater.inflate(R.layout.dialog_post_facebook, null);    			
    	
    	if(type.equals("Artists") || type.equals("Albums"))
    	{
    		alertDialogBuilder.setView(v);
    		alertDialogBuilder.setPositiveButton("Facebook", new DialogInterface.OnClickListener() {
  	           public void onClick(DialogInterface dialog, int id) {
  	        	   Intent myIntent = new Intent(context,ParseFacebook.class);
  	        	   myIntent.setAction(Intent.ACTION_SEND);
  	        	   
  	        	   myIntent.putExtra("com.example.assignment9.type",type);
  	        	   myIntent.putExtra("com.example.assignment9.cover",cover[position]);
  	        	   myIntent.putExtra("com.example.assignment9.name",name[position]);
  	        	   myIntent.putExtra("com.example.assignment9.genre",genre[position]);
  	        	   myIntent.putExtra("com.example.assignment9.year",year[position]);
  	        	   myIntent.putExtra("com.example.assignment9.details",details[position]);
  	        	   myIntent.putExtra("com.example.assignment9.title",title[position]);
  	        	   myIntent.putExtra("com.example.assignment9.artist",artist[position]);
  	        	   myIntent.putExtra("com.example.assignment9.performers",performers[position]);
  	        	   myIntent.putExtra("com.example.assignment9.composers",composers[position]);
  	        	   myIntent.putExtra("com.example.assignment9.sample",sample[position]);
	        	   
  	        	   myIntent.setType("text/plain");
  	        	   startActivity(myIntent);    	        	
  	           }
 		    });
    	}
    	else
    	{
    		alertDialogBuilder.setView(v);
    		alertDialogBuilder.setNeutralButton("Facebook    ", new DialogInterface.OnClickListener() {
  	           public void onClick(DialogInterface dialog, int id) {
  	        	   Intent myIntent = new Intent(context,ParseFacebook.class);
	        	   myIntent.setAction(Intent.ACTION_SEND);
	        	   
	        	   myIntent.putExtra("com.example.assignment9.type",type);
	        	   myIntent.putExtra("com.example.assignment9.cover",cover[position]);
	        	   myIntent.putExtra("com.example.assignment9.name",name[position]);
	        	   myIntent.putExtra("com.example.assignment9.genre",genre[position]);
	        	   myIntent.putExtra("com.example.assignment9.year",year[position]);
	        	   myIntent.putExtra("com.example.assignment9.details",details[position]);
	        	   myIntent.putExtra("com.example.assignment9.title",title[position]);
	        	   myIntent.putExtra("com.example.assignment9.artist",artist[position]);
	        	   myIntent.putExtra("com.example.assignment9.performers",performers[position]);
	        	   myIntent.putExtra("com.example.assignment9.composers",composers[position]);
	        	   myIntent.putExtra("com.example.assignment9.sample",sample[position]);
	        	   
	        	   myIntent.setType("text/plain");
	        	   startActivity(myIntent);    	        	
  	           }
 		    });
    		
    		alertDialogBuilder.setPositiveButton("Sample Music", new DialogInterface.OnClickListener() {
 	           public void onClick(DialogInterface dialog, int id) { 	        	  
 	        	  if(sample[position]!=null && !sample[position].equals("NA") && !sample[position].equals("N/A"))
 	        	   { 
 	        		  	final MediaPlayer player = MediaPlayer.create(context, Uri.parse(sample[position]));
 	        		  	player.start();
 	        		  	AlertDialog.Builder alert = new AlertDialog.Builder(context);    	
 	        		  	alert.setCancelable(false);
 	        		  	alert.setPositiveButton("Stop", new DialogInterface.OnClickListener() {
						@Override
						public void onClick(DialogInterface dialog, int which) {
							player.stop();
							//mp.seekTo(0);
							return;
						}
	            	 });
 	        		  	alert.show();
 	        	   }
 	        	  else
 	        	  {
 	        		  	AlertDialog.Builder alert = new AlertDialog.Builder(context);    	
 	        		  	alert.setNegativeButton("No Sample available", new DialogInterface.OnClickListener() {
						@Override
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
							return;
						}
					});
 	            	 alert.show();
 	        	  }	        	   		           
 	           }
		    });    		
    	}          	
    	alertDialogBuilder.show();
	}
    
    
    void parseJsonArtists(JSONArray resultsChildren,int len) throws JSONException
    {
    	for(int i=0;i<len;i++)
    	{
    		cover[i]=resultsChildren.getJSONObject(i).getString("cover").toString();
    		name[i]=resultsChildren.getJSONObject(i).getString("name").toString();
    		genre[i]=resultsChildren.getJSONObject(i).getString("genre").toString();
    		year[i]=resultsChildren.getJSONObject(i).getString("year").toString();
    		details[i]=resultsChildren.getJSONObject(i).getString("details").toString();
    	}
    }
    
    void parseJsonAlbums(JSONArray resultsChildren,int len) throws JSONException
    {
    	for(int i=0;i<len;i++)
    	{	
    		cover[i]=resultsChildren.getJSONObject(i).getString("cover").toString();
    		title[i]=resultsChildren.getJSONObject(i).getString("title").toString();
    		artist[i]=resultsChildren.getJSONObject(i).getString("artist").toString();
    		genre[i]=resultsChildren.getJSONObject(i).getString("genre").toString();
    		year[i]=resultsChildren.getJSONObject(i).getString("year").toString();
    		details[i]=resultsChildren.getJSONObject(i).getString("details").toString();
    	}
    }
    
    void parseJsonSongs(JSONArray resultsChildren,int len) throws JSONException
    {
    	/*TextView mText = (TextView)findViewById(R.id.textViewOutput);
    	//mText.setText(len+"");
    	String test="";
    	*/
    	for(int i=0;i<len;i++)
    	{
    		cover[i]=resultsChildren.getJSONObject(i).getString("cover").toString();
    		title[i]=resultsChildren.getJSONObject(i).getString("title").toString();    		  		
    		sample[i]=resultsChildren.getJSONObject(i).getString("sample").toString();
    		performers[i]=resultsChildren.getJSONObject(i).getString("performers").toString();
    		composers[i]=resultsChildren.getJSONObject(i).getString("composers").toString();
    		details[i]=resultsChildren.getJSONObject(i).getString("details").toString();
    	}
    	//mText.setText(test);
    }
}