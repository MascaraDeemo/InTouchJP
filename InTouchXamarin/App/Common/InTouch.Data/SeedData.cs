using System.Collections.Generic;
using InTouch.Models;

namespace InTouch.Data
{
	public static class SeedData
	{
		public static IEnumerable<Acquaintance> Get(string dataPartitionId)
		{
			dataPartitionId = dataPartitionId.ToUpper();

			return new List<Acquaintance>()
			{
				new Acquaintance() { DataPartitionId = dataPartitionId, FirstName = "Sam", LastName = "Zhou", Company = "QUT", JobTitle = "Student", Email = "q924714879@gmail.com", Phone = "0410733094", Street = "62 Gager Street", City = "Sunnybank", PostalCode = "4109", State = "QLD", PhotoUrl = "https://acquaint.blob.core.windows.net/images/josephgrimes.jpg" },
				new Acquaintance() { DataPartitionId = dataPartitionId, FirstName = "Fabian", LastName = "Wentz", Company = "QUT", JobTitle = "Student", Email = "fabian.wentz@connect.qut.edu.au", Phone = "0412123123", Street = "230 3rd Ave", City = "Brisbane", PostalCode = "4000", State = "QLD", PhotoUrl = "https://acquaint.blob.core.windows.net/images/monicagreen.jpg" },
				new Acquaintance() { DataPartitionId = dataPartitionId, FirstName = "Lionel", LastName = "Tan", Company = "QUT", JobTitle = "Student", Email = "iaape@gmail.com", Phone = "0497555989", Street = "22/40 Lakefield Place", City = "Runcorn", PostalCode = "4113", State = "QLD", PhotoUrl = "https://acquaint.blob.core.windows.net/images/joanmancum.jpg" },
				new Acquaintance() { DataPartitionId = dataPartitionId, FirstName = "Simon", LastName = "Liu", Company = "QUT", JobTitle = "Student", Email = "527472039@qq.com", Phone = "0449562609", Street = "31 Janice St", City = "Sunnybank hills", PostalCode = "4109", State = "QLD", PhotoUrl = "https://acquaint.blob.core.windows.net/images/alvingray.jpg" },

			};
		}
	}
}

