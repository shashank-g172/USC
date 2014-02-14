package com.example.assignment9;

public class Artist {
//	private int imageId;
	private String cover;
	private String name;
	private String genre;
	private String year;
	private String details;
	
	Artist(String cover,String name,String genre,String year,String details)
	{
		this.cover=cover;
		this.name=name;
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
	
	void setName(String name)
	{
		this.name=name;
	}
	
	String getName()
	{
		return this.name;
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
