using System;
using System.Linq;
using System.Text;
using PCLCrypto;
using static PCLCrypto.WinRTCrypto;

namespace InTouch.Util
{

    public static class GuidUtility
    {

        public static Guid Create(string value)
        {
            return Create(UrlNamespace, value);
        }

        public static Guid Create(Guid namespaceId, string name)
        {
            return Create(namespaceId, name, 5);
        }

        public static Guid Create(Guid namespaceId, string name, int version)
        {
            if (name == null)
                throw new ArgumentNullException("name");
            if (version != 3 && version != 5)
                throw new ArgumentOutOfRangeException("version", "version must be either 3 or 5.");

            // convert the name to a sequence of octets (as defined by the standard or conventions of its namespace) (step 3)
            // ASSUME: UTF-8 encoding is always appropriate
            byte[] nameBytes = Encoding.UTF8.GetBytes(name);

            // convert the namespace UUID to network order (step 3)
            byte[] namespaceBytes = namespaceId.ToByteArray();
            SwapByteOrder(namespaceBytes);

            // compute the hash of the name space ID concatenated with the name (step 4)
            var algorithmProvider = version == 3 ? HashAlgorithmProvider.OpenAlgorithm(HashAlgorithm.Md5) : HashAlgorithmProvider.OpenAlgorithm(HashAlgorithm.Sha1);
            var cryptoHash = algorithmProvider.CreateHash();

            cryptoHash.Append(namespaceBytes);
            cryptoHash.Append(nameBytes);

            var hash = cryptoHash.GetValueAndReset().ToArray();

            // most bytes from the hash are copied straight to the bytes of the new GUID (steps 5-7, 9, 11-12)
            var newGuid = new byte[16];
            Array.Copy(hash, 0, newGuid, 0, 16);

            // set the four most significant bits (bits 12 through 15) of the time_hi_and_version field to the appropriate 4-bit version number from Section 4.1.3 (step 8)
            newGuid[6] = (byte)((newGuid[6] & 0x0F) | (version << 4));

            // set the two most significant bits (bits 6 and 7) of the clock_seq_hi_and_reserved to zero and one, respectively (step 10)
            newGuid[8] = (byte)((newGuid[8] & 0x3F) | 0x80);

            // convert the resulting UUID to local byte order (step 13)
            SwapByteOrder(newGuid);
            return new Guid(newGuid);
        }

        
        public static readonly Guid DnsNamespace = new Guid("6ba7b810-9dad-11d1-80b4-00c04fd430c8");

       
        public static readonly Guid UrlNamespace = new Guid("6ba7b812-9dad-11d1-80b4-00c04fd430c8");

        
        public static readonly Guid IsoOidNamespace = new Guid("6ba7b812-9dad-11d1-80b4-00c04fd430c8");

        // Converts a GUID (expressed as a byte array) to/from network order (MSB-first).
        internal static void SwapByteOrder(byte[] guid)
        {
            SwapBytes(guid, 0, 3);
            SwapBytes(guid, 1, 2);
            SwapBytes(guid, 4, 5);
            SwapBytes(guid, 6, 7);
        }

        private static void SwapBytes(byte[] guid, int left, int right)
        {
            byte temp = guid[left];
            guid[left] = guid[right];
            guid[right] = temp;
        }
    }
}

