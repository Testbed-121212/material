public class RandomHelper {
  private RandomHelper() {
    // Cannot be instantiated.
  }

  public static long seed(final long x) {
    final long z = (x ^ (x >>> 33)) * 0x62a9d9ed799705f5L;
    return ((z ^ (z >>> 28)) * 0xcb24d0a5c88c35b3L) >>> 32;
  }

  public static long next(final long state) {
    short s0 = (short) (state & 0xffff);
    short s1 = (short) ((state >>> 16) & 0xffff);
    short next = s0;
    next += s1;
    next = rotl(next, 9);
    next += s0;

    s1 ^= s0;
    s0 = rotl(s0, 13);
    s0 ^= s1;
    s0 ^= (s1 << 5);
    s1 = rotl(s1, 10);

    long result = next;
    result <<= 16;
    result |= s1;
    result <<= 16;
    result |= s0;
    return result;
  }

  private static short rotl(final short x, final int k) {
    return (short) ((x << k) | (x >>> (32 - k)));
  }
}
