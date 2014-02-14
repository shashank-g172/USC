package com.example.assignment9;

public class Album {
//	private int imageId;
	private String cover;
	private String title;
	private String artist;
	private String genre;
	private String year;
	private String details;
	
	Album(String cover,String title,String artist,String genre,String year,String details)
	{
		this.cover=cover;
		this.title=title;
		this.artist=artist;
		this.genre=genre;
		this.year=year;
		this.details=details;
	}
	
	void setCover(String cover)
	{
		this.cover=cover;
	}
	
	String getCover()
	{
		return this.cover;
	}
	
	void setTitle(String title)
	{
		this.title=title;
	}
	
	String getTitle()
	{
		return this.title;
	}
	
	void setArtist(String artist)
	{
		this.artist=artist;
	}
	
	String getArtist()
	{
		return this.artist;
	}
	
	void setGenre(String genre)
	{
		this.genre=genre;
	}
	
	String getGenre()
	{
		return this.genre;
	}
	
	void setYear(String year)
	{
		this.year=year;
	}
	
	String getYear()
	{
		return this.year;
	}
	
	void setDetails(String details)
	{
		this.details=details;
	}
	
	String getDetails()
	{
		return this.details;
	}
}
