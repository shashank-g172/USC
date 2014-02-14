package com.example.assignment9;

import java.util.ArrayList;

import android.R;
import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class MyCustomAdapter extends BaseAdapter {
	Context context;
	private String type;
	ArrayList <Artist> rowItemsArtist;
	ArrayList <Album> rowItemsAlbum;
	ArrayList <Song> rowItemsSong;
	Artist artist;
	Album album;
	Song song;
	
	MyCustomAdapter(Context context, ArrayList rowItems) {
        this.context = context;   
        if(rowItems.get(0) instanceof Artist) 
    	   {
        		this.type="Artists";
        		this.rowItemsArtist = rowItems;
        		
    	   }
        else if(rowItems.get(0) instanceof Album)
    	   {
        		this.type="Albums";
        		this.rowItemsAlbum=rowItems;
        		
    	   }
        else
    	   {
        		this.type="Songs";
        		this.rowItemsSong=rowItems;                     
    	   } 
    }
	
	private class ViewHolderArtist {
        ImageView image;
        TextView name;
        TextView genre;
        TextView year;
    }
	
	private class ViewHolderAlbum {
		ImageView image;
		TextView title;
		TextView artist;
		TextView genre;
        TextView year;
	}
	
	private class ViewHolderSong {
		ImageView image;
		TextView title;
		TextView performer;
		TextView composer;
	}
	
	@Override
	 public View getView(int position, View convertView, ViewGroup parent) {
		 LayoutInflater mInflater = (LayoutInflater)context.getSystemService(Activity.LAYOUT_INFLATER_SERVICE);
		 	
		 if(type.equals("Artists"))   
		 {
	    	 ViewHolderArtist artistHolder = null;
	    	 if(convertView==null)
	    	 {
	    		 convertView = mInflater.inflate(R.layout.ouput_artists, null);
	             artistHolder=new ViewHolderArtist();
	             artistHolder.genre=(TextView)convertView.findViewById(R.id.genreArtist);
	             artistHolder.image=(ImageView)convertView.findViewById(R.id.imageArtist);
	             artistHolder.name=(TextView)convertView.findViewById(R.id.nameArtist);
	             artistHolder.year=(TextView)convertView.findViewById(R.id.yearArtist);
	             convertView.setTag(artistHolder);
	    	 }
	    	 else
	    	 {
	    		 artistHolder = (ViewHolderArtist) convertView.getTag(); 
	    	 }	    	 
	    	 artist=(Artist)getItem(position);
	    	 if(artist!=null)
	    	 {
	    		 artistHolder.genre.setText("Genre: "+artist.getGenre());
	    	 
	    		 artistHolder.name.setText("Name: "+artist.getName());
	    		 artistHolder.year.setText("Year: "+artist.getYear());
	    	 
	    		 int loader=R.drawable.ic_launcher;
	    	 
	    		 String image_url =artist.getCover();
	    		 ImageView image = (ImageView) convertView.findViewById(R.id.imageArtist);
	    		 ImageLoader imgLoader = new ImageLoader(context);
	    		 imgLoader.DisplayImage(image_url, loader, image);
	    	}
	     }
	     else if(type.equals("Albums"))
	     {
	    	 ViewHolderAlbum albumHolder=null;
	    	 
	    	 if(convertView==null)
	    	 {
	    		 convertView = mInflater.inflate(R.layout.output_albums, null);
	             albumHolder=new ViewHolderAlbum();
	             albumHolder.artist=(TextView)convertView.findViewById(R.id.artistAlbum);
	             albumHolder.genre=(TextView)convertView.findViewById(R.id.genreAlbum);
	             albumHolder.image=(ImageView)convertView.findViewById(R.id.imageAlbum);
	             albumHolder.title=(TextView)convertView.findViewById(R.id.titleAlbum);
	             albumHolder.year=(TextView)convertView.findViewById(R.id.yearAlbum);
	             convertView.setTag(albumHolder);
	    	 }
	    	 else
	    	 {
	    		 albumHolder = (ViewHolderAlbum) convertView.getTag(); 
	    	 }	    	 
	    	 album=(Album)getItem(position);
	    	 if(album!=null)
	    	 {
	    		 albumHolder.genre.setText("Genre: "+album.getGenre());   	
	    		 albumHolder.artist.setText("Artist: "+album.getArtist());
	    		 albumHolder.title.setText("Title: "+album.getTitle());
	    		 albumHolder.year.setText("Year: "+album.getYear());
	    	 
	    		 int loader=R.drawable.ic_launcher;
	    	 
	    		 String image_url =album.getCover();
	    		 ImageView image = (ImageView) convertView.findViewById(R.id.imageAlbum);
	    		 ImageLoader imgLoader = new ImageLoader(context);
	    		 imgLoader.DisplayImage(image_url, loader, image);
	    	}
	     }
	     else
	     {
	    	 ViewHolderSong songHolder=null;
	    	 
	    	 if(convertView==null)
	    	 {
	    		 convertView = mInflater.inflate(R.layout.output_songs, null);
	             songHolder=new ViewHolderSong();
	             songHolder.performer=(TextView)convertView.findViewById(R.id.performerSong);
	             songHolder.image=(ImageView)convertView.findViewById(R.id.imageSong);
	             songHolder.title=(TextView)convertView.findViewById(R.id.titleSong);
	             songHolder.composer=(TextView)convertView.findViewById(R.id.composerSong);
	             convertView.setTag(songHolder);
	    	 }
	    	 else
	    	 {
	    		 songHolder = (ViewHolderSong) convertView.getTag(); 
	    	 }	    	 
	    	 song=(Song)getItem(position);
	    	 if(song!=null)
	    	 {
	    		 songHolder.composer.setText("Composer: "+song.getComposers());   	 
	    		 songHolder.title.setText("Title: "+song.getTitle());
	    		 songHolder.performer.setText("Performer: "+song.getPerformers());
	    	 
	    		 int loader=R.drawable.ic_launcher;
	    	 
	    		 String image_url =song.getCover();
	    		 ImageView image = (ImageView) convertView.findViewById(R.id.imageSong);
	    		 ImageLoader imgLoader = new ImageLoader(context);
	    		 imgLoader.DisplayImage(image_url, loader, image);
	    	}
	     }
		 return convertView; 
	 }

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		if(type.equals("Artists"))
			return rowItemsArtist.size();
		else if(type.equals("Albums"))
			return rowItemsAlbum.size();
		else
			return rowItemsSong.size();
	}

	@Override
	public Object getItem(int position) {
		// TODO Auto-generated method stub
		if(type.equals("Artists"))
			return rowItemsArtist.get(position);
		else if(type.equals("Albums"))
			return rowItemsAlbum.get(position);
		else
			return rowItemsSong.get(position);
	}

	@Override
	public long getItemId(int position) {
		// TODO Auto-generated method stub
		if(type.equals("Artists"))
			return rowItemsArtist.indexOf(getItem(position));
		else if(type.equals("Albums"))
			return rowItemsAlbum.indexOf(getItem(position));
		else
			return rowItemsSong.indexOf(getItem(position));
	}

}
