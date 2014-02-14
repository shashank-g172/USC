package com.example.assignment9;

public class Song {
	private String cover;
	private String sample;
	private String performers;
	private String composers;
	private String title;
	private String details;
	
	Song(String cover,String title,String sample,String performers,String composers,String details)
	{
		this.composers=composers;
		this.cover=cover;
		this.details=details;
		this.performers=performers;
		this.sample=sample;
		this.title=title;				
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
	
	void setSample(String sample)
	{
		this.sample=sample;
	}
	
	String getSample()
	{
		return this.sample;
	}
	
	void setPerformers(String performers)
	{
		this.performers=performers;
	}
	
	String getPerformers()
	{
		return this.performers;
	}
	
	void setComposers(String composers)
	{
		this.composers=composers;
	}
	
	String getComposers()
	{
		return this.composers;
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
